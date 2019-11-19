<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function create(Request $request)
    {
        return view('subscriptions.create',
            [
                'token' => \Braintree\ClientToken::generate()
            ]);
    }
}
