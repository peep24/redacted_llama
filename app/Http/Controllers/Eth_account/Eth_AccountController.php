<?php

namespace App\Http\Controllers\Eth_account;

use Web3\Web3;

use App\Models\Account;
use App\Models\eth_account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Web3\ValueObjects\{Transaction, Wei};

class Eth_AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

   public function create(Request $request)
   {
        
    $this->validate($request, [
            'password'=> 'required|confirmed'
        ]);

        $web3 = new Web3('http://127.0.0.1:5000');

        $password = $request->password;

        $new_eth_address = $web3->eth()->create_account($password);

        //dd($new_eth_address[0]);

        if (Auth::check())
        {
            $user_id = Auth::id();
        }

        $new_account = eth_account::create([
            'user_id' => $user_id,
            'keystore' => $new_eth_address[0]
        ]);

        return back();
   }

   public function buyEth(Request $request) {
    $web3 = new Web3('http://127.0.0.1:5000');

    $this->validate($request, [
     'amount'=>"required|numeric|between:1,100"
     ]);

    $cash_val = $request->amount;

    $eth_val = $cash_val * 0.00038;
    $eth_val2Wei = $eth_val*pow(10,17);
    $numberFormat = number_format($eth_val2Wei, 0, '.', ''); 
     if (Auth::check())
     {
         $user = Auth::user();
     }

     $bank = '0x046032591f89393e0d807f6da719cbbe031d739a';
     $to = $user->eth_account->keystore;

     //$value = new Wei('10000000000000000');
    $value = new Wei($numberFormat);
   

    $transaction = Transaction::between($bank, $to)->withValue($value);
    $hash = $web3->eth()->sendTransaction($transaction);
    //dd($web3->eth()->getTransactionByHash($hash));

    return back();

   }

}

////////////////////////////////////
 //example actions

        //$web3 = new Web3('http://127.0.0.1:5000');

        //$from = '0x046032591f89393e0d807f6da719cbbe031d739a';
        //$to = '0x942a7fa10f1ea44606330006f42d15d050f75e90';
        //$value = new Wei('10000000000000000'); 

        //old for reference
        // $value = Wei::fromEth('1'); //This method cannot handle floats. Known issue.

        //$transaction = Transaction::between($from, $to)->withValue($value);
        //$hash = $web3->eth()->sendTransaction($transaction);
        // dd($web3->eth()->getTransactionByHash($hash));

        //
        //$new_account = $web3->eth()->create_account("password");
      
        //Get all accounts
        //$accounts = $web3->eth()->accounts();
        //dd($accounts);

        //$balance = $web3->eth()->getBalance('0x942a7fa10f1ea44606330006f42d15d050f75e90');
        //dd($balance);