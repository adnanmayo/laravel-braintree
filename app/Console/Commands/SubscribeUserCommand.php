<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class SubscribeUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run this command to charge user after every month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $previousMonthDate = now()->subMonth();

        $users = User::query()->whereNotNull('braintree_id')
//            ->whereRaw('NOW() > ( subscribed_at + INTERVAL 1 MONTH)')
            ->get();
        /** @var User $user */

        foreach ($users as $user) {

            $this->chargeUser($user, 150);

        }
    }

    /**
     * @param User $user
     * @param $amount
     */
    public function chargeUser(User $user, $amount)
    {

        try {
            $charge = $user->charge($amount, [
                'recurring' => false
            ]);

            $this->creatPayments($user, $amount);
        } catch (\Exception $exception) {
            $user->subscribed_at = null;
            $user->update();
        }
    }

    /**
     * @param User $user
     * @param $amount
     */
    public function creatPayments(User $user, $amount)
    {
        $user->payments()->create([
            'amount' => $amount
        ]);
    }
}
