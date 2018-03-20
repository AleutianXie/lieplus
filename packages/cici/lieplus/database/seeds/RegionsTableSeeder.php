<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_contents = json_decode(file_get_contents(database_path('data/vendor/cici/lieplus').'/regions.json'), true);
        $provinces = $file_contents['districts'][0]['districts'];
        $adcodes = array_filter(array_dot($provinces), function ($key) {
            return Str::endsWith($key, 'adcode');
        }, ARRAY_FILTER_USE_KEY);

        $bar = $this->command->getOutput()->createProgressBar(count($adcodes));
        foreach ($provinces as $province) {
            // insert dd($region);
            $bar->advance();
            if (!empty($province['districts'])) {
                // insert
                $bar->advance();
                foreach ($province['districts'] as $city) {
                    // insert
                    $bar->advance();
                    foreach ($city['districts'] as $county) {
                        // insert
                        $bar->advance();
                    }
                }
            }
        }
        $bar->finish();
        //DB::table('regions')->insert(['code' => '110000', 'name' => '北京', 'type' =>1, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
    }
}
