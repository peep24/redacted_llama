<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class getAccountBalances implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->response = "HEllo World";
        // $web3 = new Web3('http://127.0.0.1:5000');
        // $this->response = $web3->eth()->accounts();

        // $newArr = [];
        // foreach ($accounts as $account) {
        //     $balance = $web3->eth()->getBalance($account);
        //     array_push($newArr, $account);
        // }

    }

}
