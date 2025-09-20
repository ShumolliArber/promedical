<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call(ApplicationSetting::class);
    $this->call(CompanySeeder::class);
    $this->call(PermissionTableSeeder::class);
    $this->call(RolesTableSeeder::class);
    $this->call(FrontEndSeeder::class);
    // $this->call(CreateInitialUserSeeder::class);
    $this->call(UpdatesTableSeeder::class);
  }
}
