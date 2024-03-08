<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    protected $user, $token, $link_reset_password;

    public function __construct($user, $token, $link_reset_password)
    {
        $this->user = $user['name'];
        $this->token = $token['token'];
        $this->link_reset_password = $link_reset_password;
    }

    public function build()
    {
        return $this->subject('Reset Password Tokens')->view('sisarpas.forgot_password.index', ['name' => $this->user, 'token' => $this->token, 'url' => $this->link_reset_password]);
    }
}
