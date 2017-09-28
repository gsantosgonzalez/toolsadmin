<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Validator;

use App\Invitation;

class SendInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $invite = new Invitation($request->all());
        $invite->token = str_random(50);
        $invite->save();
        return $this->view('mail.invitation', ['invite' => $invite])
                    ->to($request->email)
                    ->subject('Invitación a ToolsAdmin');
    }
}
