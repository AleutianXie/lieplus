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

        $total = count($adcodes) - 1;
        $this->command->line('插入全国'.$total.'省市县信息...'.PHP_EOL);
        $bar = $this->command->getOutput()->createProgressBar($total);
        foreach ($provinces as $province) {
            // province
            $regions = [];

            $regions[] = [
                'citycode'   => empty($province['citycode']) ? '000' : $province['citycode'],
                'adcode'     => $province['adcode'],
                'name'       => $province['name'],
                'center'     => $province['center'],
                'level'      => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())
            ];

            if (!empty($province['districts'])) {
                // city
                foreach ($province['districts'] as $city) {
                    $regions[] = [
                        'citycode' => empty($city['citycode']) ? '000' : $city['citycode'],
                        'adcode'   => $city['adcode'],
                        'name'     => $city['name'],
                        'center'   => $city['center'],
                        'level'    => 2,
                        'created_at' => date('Y-m-d H:i:s', time()),
                        'updated_at' => date('Y-m-d H:i:s', time())
                    ];
                    // county
                    foreach ($city['districts'] as $county) {
                        $regions[] = [
                            'citycode' => $county['citycode'],
                            'adcode'   => $county['adcode'],
                            'name'     => $county['name'],
                            'center'   => $county['center'],
                            'level'    => 3,
                            'created_at' => date('Y-m-d H:i:s', time()),
                            'updated_at' => date('Y-m-d H:i:s', time())
                        ];
                    }
                }
                DB::table('regions')->insert($regions);
                $bar->advance(count($regions));
            }
        }
        $bar->finish();
        $this->command->line('完成！'.PHP_EOL);
    }
}
