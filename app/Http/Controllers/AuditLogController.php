<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\AuditLog;

class AuditLogController extends Controller
{
    
    public function showAuditLog()
    {
        $audit_logs = AuditLog::with('user', 'link')->orderBy('created_at', 'desc')->get();

        return view('host.dashboard', ['audit_logs' => $audit_logs]);
    }

}

