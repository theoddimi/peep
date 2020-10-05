<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyForFollower extends Mailable
{
    use Queueable, SerializesModels;


    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Models\User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('PeeP - New Follower!')
                    ->view('emails.notifications.follower')
                    ->with(['user' => $this->user]);
    }
}
