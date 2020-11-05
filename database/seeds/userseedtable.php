<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
class userseedtable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->where('email','salmaz@yahoo.com')->first();
        if (! $user) {
            User::create(
                [
                    'name'=>'lolo',
                    'email'=>'salmaz@yahoo.com',
                    'password'=>Hash::make('123456'),
                   
                ]
                );
        }
    }
}
