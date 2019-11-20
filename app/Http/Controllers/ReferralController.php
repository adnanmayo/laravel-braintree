<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ReferralController extends Controller
{
    /**
     * @param  Request  $request
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index(Request $request, $token)
    {
        $user =  User::where('referral_link', $token)->first();
        return redirect(route('register'))
            ->withCookie(\cookie()->forever('referred_by',$user->id));
    }
}
