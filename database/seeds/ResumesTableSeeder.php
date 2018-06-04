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
/*                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
$reader->setReadDataOnly(true);
$reader->setLoadSheetsOnly("简历列表");
$spreadsheet = $reader->load(storage_path('resumes/24.xls'));
$worksheet = $spreadsheet->getActiveSheet();
// Get the highest row and column numbers referenced in the worksheet
$highestRow = $worksheet->getHighestRow(); // e.g. 10
// $highestRow = 5; // e.g. 10
$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5

for ($row = 1; $row <= $highestRow; ++$row) {
    if($row == 1)
        continue;
    $id = trim($worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $name = trim($worksheet->getCellByColumnAndRow(2, $row)->getValue());
    $gender = trim($worksheet->getCellByColumnAndRow(3, $row)->getValue()) == '女' ? 2 : 1;
    $degree_text = trim($worksheet->getCellByColumnAndRow(5, $row)->getValue());
    $degree = 2;
    if ($degree_text == '大专') {
        $degree = 1;
    }
    if ($degree_text == '硕士') {
        $degree = 3;
    }
    if ($degree_text == '博士') {
        $degree = 4;
    }
    $mobile = trim($worksheet->getCellByColumnAndRow(9, $row)->getValue());
    $email = trim($worksheet->getCellByColumnAndRow(10, $row)->getValue());
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

    if (!empty($name)) {
        $resume = Resume::create($attributes);
    }
}
        $this->command->line(PHP_EOL.'OK!'.PHP_EOL);
        exit;
        */
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
        foreach (Resume::all() as $resume) {
            //$this->command->line('给简历生成10条反馈...'.PHP_EOL);
            // $feedbacks = [];
            // foreach ($faker->sentences(10) as $sentence) {
            //     $feedbacks[] = ['text' => $sentence, 'created_by' => 1];
            // }
            // $resume->postFeedbacks($feedbacks);
            $resume->assignUser(['created_by' => 1, 'updated_by' => 1], 1);
            // $resume->removeUser(1);
            // dd('OK');
        }
        
        $this->command->line(PHP_EOL.'完成！'.PHP_EOL);
    }
}
