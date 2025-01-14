<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Mail;
use App\Mail\AccessNotificationMail;
use App\Mail\SendTwoFactorCode;
use DB;
use Auth;
use Str;
use Carbon\Carbon;
use App\Models\Guest;
use App\Models\AuditLog;
use App\Models\TwoFactor;

class DoorController extends Controller
{
    //if link was used, optionally create a Two Factor Authentication code and Audit Log
    /**
     * @param Request $request
     * @param mixed $inviteLink
     * 
     * @return \View 'guest.link'
     * @return mixed $validfrom
     * @return mixed $expiresAt
     * @return mixed $isValid
     * @return \View 'guest.access'
     * @return mixed $links->guest
     * @return mixed $links
     * 
     */
    public function accessController(Request $request, $inviteLink)
    {
        $links = Link::with(['user', 'guest'])->findOrFail($inviteLink);
        $now = now()->setTimezone('Europe/Berlin');
        $isValid = false;
    
        // Test Link validity
        if ($links->valid_from && $links->expires_at) {
            $validFrom = Carbon::parse($links->valid_from)->setTimezone('Europe/Berlin');
            $expiresAt = Carbon::parse($links->expires_at)->setTimezone('Europe/Berlin');
    
            if ($validFrom > $now) {
                $isValid = true;
                return view(view: 'guest.link')
                ->with('validFrom', $validFrom)
                ->with('expiresAt', $expiresAt)
                ->with('isValid', $isValid);
            }
            if ($expiresAt < $now) {
                $isValid = false;
                return view('guest.link', ['validFrom' => $validFrom, 'expiresAt' => $expiresAt, 'isValid' => $isValid]);
            }
        }
        // If Link has 2 Factor
        if ($links->two_factor_enabled) {
            TwoFactor::create([
                'link_id' => $links->id,
                'code' => Str::random(6),
                'valid_until' => now()->addMinutes(10),
            ]);
            $twoFactorAuth = TwoFactor::where('link_id', $links->id)->first();
            // Create Audit Log for Access door with 2FA
            AuditLog::create([
                'created_by' => $links->id,
                'guest' => $links->id,
                'action' => 'door opened with 2FA',
            ]);
            Mail::to($links->guest->email)->send(new SendTwoFactorCode($twoFactorAuth->code));
            return view('guest.access', ['guest_id' => $links->guest, 'inviteLink' => $links]);
        }else{
        // Create Audit Log for Access door without 2FA
        AuditLog::create([
            'created_by' => $links->id,
            'guest' => $links->id,
            'action' => 'door opened without 2FA',
        ]);
    
        // Access Email notification for the Host
        Mail::to($links->user->email)->send(new AccessNotificationMail($links->guest, $links->user));
    
        $url = "http://192.168.100.116/rpc/Switch.Set?id=0&on=true&toggle_after=5";
    
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        $resp = curl_exec($curl);
        curl_close($curl);
    
        //echo $resp;

        }
        // Door Access without 2FA
        return view('guest.access_granted', ['guest_id' => $links->guest, 'inviteLink' => $links]);
    }
    


    //Function to Control the Two Factor Authentication Code
    /**
     * @param Request $request
     * @param mixed $inviteLink
     * 
     * @return [type]
     */
    public function twoFactorVerify(Request $request, $inviteLink)
    {
        $link = Link::with(['user', 'guest'])->findOrFail($inviteLink);

        // 2FA Code Control
        $twoFactor = TwoFactor::where('link_id', $link->id)
            ->where('code', $request->input('two_factor'))
            ->first();

        if (!$twoFactor) {
            return redirect()->back()->withErrors(['two_factor' => 'Invalid or expired two-factor authentication code.']);
        }

        // Code delete after use
        $twoFactor->delete();

        // Access Email notification for the Host
        Mail::to($link->user->email)->send(new AccessNotificationMail($link->guest, $link->user));

        $url = "http://192.168.100.116/rpc/Switch.Set?id=0&on=true&toggle_after=5";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($curl);
        curl_close($curl);

        //echo $resp;

        return view('guest.access_granted', ['inviteLink' => $link]);
    }

}

