<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use League\Flysystem\UrlGeneration\TemporaryUrlGenerator;
use URL;
use Mail;
use Auth;
use DB;
use Hash;
use Str;
use App\Models\User;
use App\Mail\InviteLinkMail;
use App\Mail\ResendInviteMail;
use App\Models\AuditLog;
use App\Models\Guest;
use App\Models\TwoFactor;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class HostController extends Controller
{

    public function dashboard()
    {
        $guests = Guest::where('guest_of', Auth::user()->id)->paginate(5);
        $audit_logs = AuditLog::with('createdBy.user', 'usedBy.guest')->get();
        return view('host.dashboard', ['guests' => $guests, 'audit_logs' => $audit_logs]);
    }

    public function allGuests()
    {
        $guests = Guest::where('guest_of', Auth::user()->id)->paginate(5);
        return view('host.allGuests', ['guests' => $guests]);
    }

    // Guests Account controller
    public function addGuest(Request $request)
    {
        $guests = Guest::create([
            'guest_of' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email
        ]);
        return redirect()->route('host.allGuests')->with('message', 'Guest added successfully');
    }

    public function showGuest($id)
    {
        $guest = Guest::findOrFail($id);
        $links = Link::where('guest_id', $id)->paginate(5);
        $audit_logs = AuditLog::with('createdBy.user', 'usedBy.guest')
            ->whereHas('usedBy', function ($query) use ($id) {
                $query->where('guest_id', $id);
            })->paginate(5);

        return view('host.guest-show', compact('guest', 'links', 'audit_logs'));
    }


    public function updateGuest(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);
        $guest->name = $request->input('name');
        $guest->email = $request->input('email');
        $guest->save();

        return redirect()->route('host.guest-show', $guest)->with('message', 'Guest updated successfully');
    }

    public function deleteGuest($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return redirect()->route('host.allGuests', $guest)->with('message', 'Guest deleted successfully');
    }

    public function sendInvite(Request $request, $id)
    {
        $validated = $request->validate([
            'more_time_start_date' => 'required|date',
            'more_time_start_time' => 'required|date_format:H:i',
            'more_time_end_date' => 'required|date',
            'more_time_end_time' => 'required|date_format:H:i',
            'enable_two_factor' => 'nullable|boolean',
        ]);

        $guest = Guest::findOrFail($id);
        $user = Auth::user();

        $validFrom = Carbon::createFromFormat('Y-m-d H:i', $request->more_time_start_date . ' '
            . $request->more_time_start_time, 'Europe/Berlin')->setTimezone('Europe/Berlin');
        $expiresAt = Carbon::createFromFormat('Y-m-d H:i', $request->more_time_end_date . ' '
            . $request->more_time_end_time, 'Europe/Berlin')->setTimezone('Europe/Berlin');

        $isTwoFactorEnabled = $request->input('enable_two_factor', 0);

        $token = null;

        $inviteLink = Link::create([
            'guest_id' => $guest->id,
            'created_by' => $user->id,
            'valid_from' => $validFrom,
            'expires_at' => $expiresAt,
            'token' => $token,
            'days' => json_encode($request->days),
            'two_factor_enabled' => $isTwoFactorEnabled,
        ]);

        $token = URL::temporarySignedRoute('guest.access', $expiresAt, ['inviteLink' => $inviteLink->id]);

        $inviteLink->update(['token' => $token]);

        Log::info('token updated ' . $token);

        AuditLog::create([
            'created_by' => $inviteLink->id,
            'guest' => $inviteLink->id,
            'action' => 'invite created',
        ]);

        Mail::to($guest->email)->send(new InviteLinkMail($token, $inviteLink, $validFrom, $expiresAt));

        return redirect()->route('host.guest-show', $id)->with('message', 'Invite sent successfully');
    }

    public function resendInvite($id)
    {
        $link = Link::findOrFail($id);

        $token = $link->token;

        $guest = Guest::findOrFail($link->guest_id);

        Mail::to($guest->email)->send(new ResendInviteMail($link, $token));

        return redirect()->route('host.guest-show', $guest->id)->with('success', 'Link sent successfully');
    }


    // User Account controller

    public function showAccount()
    {
        $user = Auth::user();
        return view('host.account', compact('user'));
    }

    public function updateAccount(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('host.account', $id)->with('message', 'User updated successfully');
    }

    public function deleteAccount($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('welcome')->with('message', 'Account deleted successfully');
    }

    public function editAccount()
    {
        return view('host.account-edit');
    }

    // Audit Logs controller

    public function showAuditLogs()
    {
        $guests = Guest::where('guest_of', Auth::user()->id)->get();
        $audit_logs = AuditLog::with('createdBy.user', 'usedBy.guest')->paginate(5);
        return view('host.allActivities', ['guests' => $guests, 'audit_logs' => $audit_logs]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $audit_logs = AuditLog::whereHas('createdBy.user', function ($query) use ($search) {
            $query->where('first_name', 'like', "%$search%");
        })
            ->orWhereHas('usedBy.guest', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('host.allActivities', compact('audit_logs'));
    }

    public function filterNachName(Request $request)
    {
        $selectedGuestIds = $request->input('guests', []);

        $guests = Guest::all();

        $audit_logs = AuditLog::when(count($selectedGuestIds) > 0, function ($query) use ($selectedGuestIds) {
            $query->whereHas('usedBy.guest', function ($query) use ($selectedGuestIds) {
                $query->whereIn('id', $selectedGuestIds);
            });
        })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('host.allActivities', compact('audit_logs', 'guests'));
    }

    public function deleteLink($id)
    {
        $link = Link::findOrFail($id);
        $guestId = $link->guest_id;
        $link->delete();

        return redirect()->route('host.guest-show', $guestId)->with('success', 'Link deleted successfully.');
    }

}
