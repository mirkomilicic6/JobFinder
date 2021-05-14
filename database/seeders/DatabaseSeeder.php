<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         Category::truncate();
         User::factory(20)->create();
         Company::factory(20)->create();
         Job::factory(20)->create();

         $categories = [
             'Technology',
             'Engineering',
             'Government',
             'Medical',
             'construction',
             'Software'
         ];

         foreach($categories as $category) {
             Category::create(['name' => $category]);
         }

         Role::truncate();
         $adminRole = Role::create(['name' => 'admin']);

         $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123123123'),
            'email_verified_at' => NOW()
         ]);
        $admin->roles()->attach($adminRole);
    }
}
