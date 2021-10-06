<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Anu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 100; $i++) {
            $id_pemasukan = "INC";
            $id_pengeluaran = "OUT";

            if(($i % 2) == 0) {
                $id = $id_pemasukan."-".generateRandomNumber(15);
                $notes = "Menabung didompet";
            } else {
                $id = $id_pengeluaran."-".generateRandomNumber(15);
                $notes = "Mengeluarkan uang untuk jajan";
            }
            $list_month = ['09', '08', '07', '06'];
            $list_month = $list_month[mt_rand(0, count($list_month) - 1)];
            DB::insert('insert into catatans (id, users_id, nominal, notes, created_at) values (?, ?, ?, ?, ?)', [$id, rand(1, 9), rand(1,999).'000.00000000', $notes, '2021-'.$list_month.'-'.$list_month.' 00:11:33']);
        }

    }
}
