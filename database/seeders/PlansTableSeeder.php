<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Free Plan',
            'monthly_price' => 0,
            'annual_price' => 0,
            'trial_days' => 7,
            'max_locations' => 5,
            'max_users' => 5,
            'max_wo' => 5,
            'image' => 'free_plan.png',
            'status' => 1,
        ]);
    }
}
