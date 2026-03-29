<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = Activity::with('causer')->latest()->get();

        return view('backend.activity_logs.index', compact('logs'));
    }
}
