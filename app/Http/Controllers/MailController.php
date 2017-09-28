<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Mail;

use App\Mail\SendInvitation;

class MailController extends Controller
{

	public function __construct()
	{
		$this->middleware('isAdmin');
	}

    public function sendMail(Request $request)
    {
    	$validation = Validator::make($request->all(), [
            'email' => 'required|email|unique:invitations',
            'typeUser_id' => 'required|min:1|max:3'
        ]);

        if($validation->fails()){
            return response()->json(['status' => 0, 'errors' => $validation->errors()]);
        }

    	Mail::send(new SendInvitation());
    }
}
