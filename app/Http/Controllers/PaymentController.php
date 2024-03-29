<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    /**
     * Process the payment
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function process(Request $request)
    {
        /** @var User $user */
        $user = $request->user();


        try {

            $amount = 150;
            if (!$user->hasBraintreeId()) {
                $customer = $user->createAsBraintreeCustomer($request->nonce);
                $amount = 200;
            }
            $user->charge($amount,
                [
                    'recurring' => false
                ]);
            $this->createPaymentRecord($user, $amount);
            $this->updateUser($user);

            session()->flash('status', 'Subscribed successfully amount '. $amount);

            return redirect()->route('home');

        } catch (\Exception $exception) {
            session()->flash('status', 'There is an error occurred while subscribing');

            return redirect()->route('home');
        }
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
