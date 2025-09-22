<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ApplicationSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ApplicationSetting::create([
            'item_name' => 'ProMedical',
            'item_short_name' => 'ProMedical',
            'item_version' => '1.0',
            'company_name' => 'Arber Shumolli',
            'company_email' => 'arbershumolli@gmail.com',
            'company_address' => 'Ferizaj, Kosovo',
            'developed_by' => 'Arber Shumolli',
            'developed_by_href' => 'https://arbershumolli.com/',
            'developed_by_title' => 'Your hope our goal',
            'developed_by_prefix' => 'Developed by',
            'support_email' => 'arberhsumolli@gmail.com',
            'language' => 'en',
            'is_demo' => '0',
            'time_zone' => 'Eurpoe/Belgrade',
        ]);
    }
}
