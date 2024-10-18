<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckUserStatus
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        // Log a message to check if this code is running
        Log::info('CheckUserStatus listener triggered for user ID: ' . $user->id);

        // If the user's status is 'pending', log them out and redirect to a waiting page
        if ($user->status === 'pending') {
            Auth::logout();
            // return redirect()->route('waiting-room')->with('message', 'Your account is awaiting approval.');
            session()->flash('message', 'Your account is awaiting approval.');
        }
    }
}

