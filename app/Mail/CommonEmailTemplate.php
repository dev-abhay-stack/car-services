<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommonEmailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $email;
    public $password;
    public $app_name;
    
    public function __construct($email,$password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->app_name = config('app.name');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      
        return $this->markdown('mail.common-email-template')->subject('Received Login Detail' . env('APP_NAME'))->with(
            [
                'email' => $this->email,
                'password' => $this->password,
                'app_name' => $this->app_name,
            ]
        );
    }
}
