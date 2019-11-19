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

    /**
     * Cancel the subscription
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request)
    {
        $user = $request->user();

        $user->braintree_id = null;
        $user->update();

        session()->flash('status', 'successfully cancelled');

        return redirect()->route('home');
    }
}
