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

        try{

            $customer = $user->createAsBraintreeCustomer($request->nonce);
            $charge = $user->charge(200,
                [
                    'recurring' => false
                ]);
            $this->createPaymentRecord($user, 200);
            $this->updateUser($user);

            session()->flash('status', 'Subscribed successfully');

            return redirect()->route('home');

        }catch (\Exception $exception){
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
