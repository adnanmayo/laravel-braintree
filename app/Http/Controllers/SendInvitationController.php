<?php

namespace App\Http\Controllers;

use App\Notifications\InvitationNotification;
use App\User;
use Illuminate\Http\Request;

class SendInvitationController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = User::findorFail(auth()->id());
        return view('invitation/sendinvitation', compact('user'));
    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invitationByMail(Request $request)
    {
        $authUser = User::findOrFail(auth()->id());

        $user = new User();
        $user->email = $request->email;

        $details = [
            'greeting' => $request->email,
            'body' => $request->message,
        ];
        $user->notify(new InvitationNotification($details, $authUser));

        \Session::flash('alert-success', 'Invitation sent successfully!');
        return redirect()->back();
    }
}
