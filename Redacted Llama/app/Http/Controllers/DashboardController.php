<?php

namespace App\Http\Controllers;

use Web3\Web3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function index(Request $request)
    {
        $web3 = new Web3('http://127.0.0.1:5000');

        if (Auth::check())
        {
            $user = Auth::user();
        }
        
        if($user->eth_account) {
            $eth_account = $user->eth_account;
            $balance_wei = $web3->eth()->getBalance($user->eth_account->keystore);
            $balance = number_format($balance_wei->toEther(), 5);
            
            return view('dashboard', ["balance"=>$balance]);
        }

        return view('dashboard');
    }
}
