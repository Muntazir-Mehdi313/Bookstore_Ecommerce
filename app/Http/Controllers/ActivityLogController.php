<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Concerns\ExportsCsv;

class ActivityLogController extends Controller
{
    use ExportsCsv;

    /**
     * Display a listing of activity logs.
     */
    public function index()
    {
        $logs = ActivityLog::orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(7);

        return view('activity_log.index', compact('logs'));
    }
}