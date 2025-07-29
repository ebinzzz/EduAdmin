<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;
    public $userType;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $password, $userType = 'teacher')
    {
        $this->user = $user;
        $this->password = $password;
        $this->userType = $userType;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->userType === 'teacher' 
            ? 'Welcome to Our School - Your Login Credentials' 
            : 'Welcome Student - Your Login Credentials';

        return $this->subject($subject)
                    ->view('emails.credentials')
                    ->with([
                        'user' => $this->user,
                        'password' => $this->password,
                        'userType' => $this->userType,
                        'loginUrl' => url('/login'),
                    ]);
    }
}