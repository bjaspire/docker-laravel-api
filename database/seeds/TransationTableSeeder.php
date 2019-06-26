<?php

use Illuminate\Database\Seeder;
use App\Transaction;

class TransationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Transaction::class, 10)->create();
    }
}
