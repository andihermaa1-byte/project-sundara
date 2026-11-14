<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RfidCard;

class RfidCardSeeder extends Seeder
{
    public function run(): void
    {
        $cards = [
            // Ngalagena
            ['uid' => 'UID_KA', 'name' => 'Ka', 'char_sundanese' => 'ᮊ', 'type' => 'ngalagena', 'latin' => 'ka'],
            ['uid' => 'UID_GA', 'name' => 'Ga', 'char_sundanese' => 'ᮌ', 'type' => 'ngalagena', 'latin' => 'ga'],
            ['uid' => 'UID_MA', 'name' => 'Ma', 'char_sundanese' => 'ᮙ', 'type' => 'ngalagena', 'latin' => 'ma'],
            ['uid' => 'UID_NA', 'name' => 'Na', 'char_sundanese' => 'ᮔ', 'type' => 'ngalagena', 'latin' => 'na'],
            ['uid' => 'UID_BA', 'name' => 'Ba', 'char_sundanese' => 'ᮘ', 'type' => 'ngalagena', 'latin' => 'ba'],
            // Rarangken
            ['uid' => 'UID_PANGHULU', 'name' => 'Panghulu', 'char_sundanese' => 'ᮤ', 'type' => 'rarangken', 'latin' => 'i (di atas)'],
            ['uid' => 'UID_PANYUKU', 'name' => 'Panyuku', 'char_sundanese' => 'ᮥ', 'type' => 'rarangken', 'latin' => 'u (di bawah)'],
            ['uid' => 'UID_PAMAEH', 'name' => 'Pamaéh', 'char_sundanese' => '᮪', 'type' => 'rarangken', 'latin' => 'paten/matikan'],
            ['uid' => 'UID_PAMEPET', 'name' => 'Pamepet', 'char_sundanese' => 'ᮩ', 'type' => 'rarangken', 'latin' => 'e (pepet)'],
        ];

        foreach ($cards as $card) {
            RfidCard::updateOrCreate(['uid' => $card['uid']], $card);
        }
    }
}