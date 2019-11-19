<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    /**
     * Process the payment
     *
     * @param Request $request
     * @throws \Exception
     */
    public function process(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $customer = $user->createAsBraintreeCustomer($request->nonce);
        $charge = $user->charge(200,
            [
                'recurring' => false
            ]);


    }

    /**
     * @param User $user
     * @param $amount
     */
    public function createPaymentRecord(User $user, $amount)
    {
        $user->payments()->create([
            'amount' => $amount
        ]);
    }

    /**
     * @param User $user
     */
    private function updateUser(User $user)
    {
        $user->subscribed_at = now();
        $user->update();
    }
}
