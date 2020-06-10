<?php

use App\Models\Key;
use Illuminate\Database\Seeder;

class KeyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Key::class, 50)->make()->each(function (Key $key) {
            $key->user()->associate(\App\Models\User::find(1));
            $key->save();
        });
    }
}
