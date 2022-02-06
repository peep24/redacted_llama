<?php

namespace App\Http\Controllers\API;

use Web3\Web3;

use Web3\ValueObjects\Wei;
use Illuminate\Http\Request;
use App\Jobs\getAccountBalances;
use Web3\ValueObjects\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ethAPIController extends Controller
{
    public function getBalance(Request $request) {
         $web3 = new Web3('http://127.0.0.1:5000');
    
         if (Auth::check())
         {
             $user = Auth::user();
         } 
    
         $balance = $web3->eth()->getBalance($user->eth_account->keystore);
         dd(number_format($balance->toEther(), 5));
    }

    public function getBankBalance(Request $request) {
        $web3 = new Web3('http://127.0.0.1:5000');

        if (Auth::check())
        {
            $user = Auth::user();
        } 

        $balance = $web3->eth()->getBalance('0x046032591f89393e0d807f6da719cbbe031d739a');
        dd(number_format($balance->toEther(), 5));
    }

    public function updateAccounts(Request $request) {
        $job = new getAccountBalances();
        $data = $this->dispatch($job);

    }

    public function fund(Request $request) {
   
        $web3 = new Web3('http://127.0.0.1:5000');

        if (Auth::check())
        {
            $user = Auth::user();
        }
    
        $this->validate($request, [
         'amount'=>"required|numeric|between:1,100"
         ]);
        
        $cash_val = $request->amount;
    
        $eth_val = $cash_val * 0.00038;
        $eth_val2Wei = $eth_val*pow(10,17);
        $numberFormat = number_format($eth_val2Wei, 0, '.', ''); 

        $bank = '0x046032591f89393e0d807f6da719cbbe031d739a';
        $to = $user->eth_account->keystore;
    
        $value = new Wei($numberFormat);
           
        $transaction = Transaction::between($bank, $to)->withValue($value);
        $hash = $web3->eth()->sendTransaction($transaction);
        
        dd($web3->eth()->getTransactionByHash($hash));

    }
    
}
