<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $transactions = [
            [
                'no_transaksi' => 'TR-00001',
                'user_id' => 6,
                'type' => 'Tarik',
                'amount' =>  1000,
            ],
            [
                'no_transaksi' => 'TR-00002',
                'user_id' => 6,
                'type' => 'Setor',
                'amount' =>  5000,
            ],
            [
                'no_transaksi' => 'TR-00003',
                'user_id' => 6,
                'type' => 'Tarik',
                'amount' =>  6000,
            ],
        ];
        foreach ($transactions as $data){
            transaction::insert([
                'no_transaksi' => $data['no_transaksi'],
                'user_id' => $data['user_id'],
                'type' => $data['type'],
                'amount' => $data['amount'],
                'created_at' => Carbon::now()->format('Y-m-d'),
                'updated_at' => Carbon::now()->format('Y-m-d'),
            ]);
        }
    }
}
