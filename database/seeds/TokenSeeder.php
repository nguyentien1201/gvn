<?php

use App\Models\Token;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TokenSeeder extends Seeder
{
    public function run()
    {
        DB::table('tokens')->truncate();
        DB::table('orders')->truncate();
        //demo web: http://ast.vacaha.com/
        Token::insert(
            [
                [
                    'website' => 'ast.vacaha.com',
                    'domain' => 'http://ast.vacaha.com',
                    'consumer_key' => 'qNAmd7uGOveO',
                    'consumer_secret' => 'WE3vCItV9QCpN7HgTiR6vjHfb81AmOswl5zaycOBu313TG6p',
                    'access_token' => 'o1lkEk8T4Brlrglvjs9CItKo',
                    'access_token_secret' => 'chWbQ7HnU4DqYZxOCN3bUEM6tc1fQFak7fEsHaZBtjr6aXKt'
                ],
                [
                    'website' => 'webmau.vacaha.com',
                    'domain' => 'http://webmau.vacaha.com',
                    'consumer_key' => 'swKErSHzogRt',
                    'consumer_secret' => 'SiQeNrz7b7fsNS7LdRiavVQovEETy4fFPswA4boBfMH0fgTM',
                    'access_token' => 'hnZ0EmGtH0scstCXmdMTyTSY',
                    'access_token_secret' => 'AeGlzwqPb1e6etklL05D0qYgqOngPnWmF8LQ1y2JXCFImezA'
                ]
            ]
        );
    }
}
