<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TimeController extends Controller
{
    public function show() {
        $timeMsg = now()->toDateTimeString();
        $msg = "Current time " . $timeMsg . " that is requested";
        Log::info($msg);
        return [
            'message' => $msg,
            'time' => $timeMsg
        ];
    }
}
