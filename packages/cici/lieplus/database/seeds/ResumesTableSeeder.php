<?php

use Carbon\Carbon;
use Cici\Lieplus\Models\Resume;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ResumesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
$reader->setReadDataOnly(true);
$reader->setLoadSheetsOnly("简历列表");
$spreadsheet = $reader->load('/home/vagrant/cici/lieplus/lieplus_01.xls');
$worksheet = $spreadsheet->getActiveSheet();
// Get the highest row and column numbers referenced in the worksheet
$highestRow = $worksheet->getHighestRow(); // e.g. 10
$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5

for ($row = 1; $row <= $highestRow; ++$row) {
    if($row == 1)
        continue;
    $id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
    $name = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
    $gender = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
    $degree = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
    $mobile = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
    $email = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
    $others = $worksheet->getCellByColumnAndRow(13, $row)->getValue();

    $birthdate = '1970-01-01';
    $start_work_date = '2000-01-01';

    $service_status = 1;
    $province = '110000';
    $city = '110100';
    $county = '110105';
    $position = $name;
    $industry = '互联网软件';
    $salary = 1;
    $created_by = 1;
    $updated_by = 1;

    $attributes = compact('name', 'gender', 'degree', 'mobile', 'email', 'others', 'birthdate', 'start_work_date', 'service_status', 'city', 'province', 'county', 'position', 'industry', 'salary', 'created_by', 'updated_by');

    $resume = Resume::create($attributes);

}
        $this->command->line(PHP_EOL.'OK!'.PHP_EOL);

        // 随机生成100份简历
        $faker = Factory::create('zh_CN');
        $positions = [
            '人事部经理',
            '热处理工程师',
            '人力资源行政',
            '人事专员助理',
            '人事业务助理',
            '软件助理',
            '研发工程师',
            '软件开发java实习生',
            '认定工程师',
            '软件开发工程师',
            '软件测工程师',
            '日语人事',
            '人力行政总监',
            '人事助理实习生',
            '人力资源代表',
            '认证专员',
            '人力资源副经理',
            '日语行政',
            '软件开发程序员',
            '人力行政经理',
            '软件JAVA开发工程师',
            '软件主任',
            '人力行政助理',
            '软件测试工程',
            '软件研发助理工程师',
            '软件运营'
        ];
        $industries = [
            '互联网',
            '游戏',
            '软件',
            '电商',
            '网络游戏',
            '计算机软件',
            'IT服务',
            '电子',
            '通信',
            '硬件',
            '房地产',
            '建筑',
            '物业',
            '金融',
            '消费品',
            '汽车',
            '机械',
            '制造',
            '制药',
            '医疗',
            '能源',
            '化工',
            '环保',
            '服务',
            '外包',
            '中介',
            '广告',
            '传媒',
            '教育',
            '文化',
            '交通',
            '贸易',
            '物流',
            '政府',
            '农林牧渔'
        ];
        $this->command->line('随机生成1000份简历...'.PHP_EOL);
        $this->command->line('给每份简历生成10条反馈...'.PHP_EOL);
        $bar = $this->command->getOutput()->createProgressBar(1000);
        for ($i = 0; $i < 1000; $i++) {
            $dt = $faker->dateTime('-30 years');
            $birthdate = $faker->date('Y-m-d', $dt);
            $carbon = Carbon::instance($dt);
            $carbon->addYears(20);
            $start_work_date = $faker->dateTimeBetween($carbon, '-2 years')->format('Y-m-d');
            $attributes = [
                'name' => $faker->unique()->name,
                'mobile' => $faker->unique()->phoneNumber,
                'email' => $faker->unique()->email,
                'gender' => $faker->numberBetween(1, 2),
                'birthdate' => $birthdate,
                'start_work_date' => $start_work_date,
                'degree' => $faker->numberBetween(1, 4),
                'service_status' => $faker->numberBetween(1, 2),
                'province' => '110000',
                'city' => '110100',
                'county' => '110105',
                'position' => $faker->randomElements($positions, 1)[0],
                'industry' => $faker->randomElements($industries, 1)[0],
                'salary' => $faker->numberBetween(1, 5),
                'others' => addslashes($faker->randomHtml()),
                'created_by' => 1,
                'updated_by' => 1
            ];
            $resume = Resume::create($attributes);
            $resume->assignUser(['created_by' => 1, 'updated_by' => 1], 1);
            $feedbacks = [];
            foreach ($faker->sentences(10) as $sentence) {
                $feedbacks[] = ['text' => $sentence, 'created_by' => 1];
            }
            $resume->postFeedbacks($feedbacks);
            $bar->advance();
        }
        $bar->finish();
        $this->command->line(PHP_EOL.'完成！'.PHP_EOL);
    }
}
