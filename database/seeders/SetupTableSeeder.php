<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class SetupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('email', '=', 'owner@example.com')->first();
        $admin->userDefaultData();
    }
}
