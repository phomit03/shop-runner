<?php

use App\Models\Transaction;
use \Illuminate\Support\Facades\Auth;

//Day la noi khai bao cac ham helper (do minh tu tao ra)

function isAdmin(){ //check xem coo phai la admin hay khong?
    if (!Auth::check()){
        return false;
    }
    if (Auth::user()->isAdmin){
        return true;
    }
    return false;
}


function url_after_login(){
    if (isAdmin()){
        return "/admin";
    }
    return "/";
}

function getOptionsPayment(){
    return [
        '' => 'choose',
        'cash on delivery' => 'Cash on delivery',
        'online card payment' => 'Online card payment',
        'online bank transfer' => 'Online bank transfer',
        'standard bank order' => 'Standard bank order',
        'mobile phone payment' => 'Mobile phone payment',
        'digital wallet payment' => 'Digital wallet payment',
        'coupon payment' => 'Coupon payment',
    ];
}

function getSatusTransaction(){
    return [
        '0' => 'Failed',
        '1' => 'Successful',
    ];
}

function getStatusOrder(){
    return [
        '' => 'choose',
        '0' => 'Failed',
        '1' => 'Successful',
    ];
}


