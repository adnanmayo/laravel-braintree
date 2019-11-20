<?php


namespace App\Service;


class ReferralLink
{

    public static function generateReferalLink(){
        return str_random(50);
    }
}
