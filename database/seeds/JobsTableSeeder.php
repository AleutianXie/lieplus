<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('customers')->insert([
            'id'         => 1,
            'sn'         => 'KH' . date('Ymdhis', time()) . sprintf('%4d', mt_rand(0, 9999)),
            'name'       => '比特大陆',
            'province'   => '110000',
            'city'       => '110100',
            'county'     => '110101',
            'welfare'    => '五险一金全额缴纳',
            'worktime'   => '朝九晚六',
            'founder'    => 'NULL',
            'financing'  => 'c轮',
            'industry'   => '互联网软件',
            'ranking'    => '前三名',
            'property'   => '外商独资/外企办事处',
            'size'       => '1-49人',
            'introduce'  => '1、比特大陆的优势：公司稳定——业务稳定，员工稳定。（2013成立，200多人，适合希望稳定的员工，又不失发展空间，有很多新项目）
2、比特大陆的产品，蚂蚁矿机、蚂蚁矿池、算力巢、比特币（比特大陆旗下的蚂蚁矿机Antminer、蚁池Antpool、云算力HashNest均排名全球市场第一）
3、上班时间：9:30-6:00，可以办理居住证              比特大陆适合的候选人来源：
1、男生；2、985/211院校毕业。
3、工作5年以上，技术能力强。',
            'level'      => '未设置',
            'type'       => '未设置', 'show' => 1,
            'creater'    => 1, 'modifier' => 1,
            'closed'     => 0,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);

        DB::table('departments')->insert([
            'id'         => 1,
            'cid'        => 1,
            'name'       => '技术部门',
            'show'       => 1,
            'creater'    => 1,
            'modifier'   => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);

        DB::table('jobs')->insert([
            'id'          => 1,
            'sn'          => 'ZW' . date('Ymdhis', time()) . sprintf('%4d', mt_rand(0, 9999)),
            'cid'         => 1,
            'did'         => 1,
            'name'        => 'java开发',
            'requirement' => '"岗位职责1、按照软件需求进行业务需求分析和软件设计；
2、进行软件详细设计和编码实现，确保安全、质量和性能；
3、 维护和升级现有软件产品，快速定位并修复现有软件缺陷。"  "任职条件1、熟练使用J2EE相关技术和框架(struts、spring、hibernate、ibatis中二种或以上)；
2、熟悉Jquery、JSP、javascript、AJAX、WebService、SOAP等开发技术及HTML语言；----了解
3、熟悉WebSphere/WebLogic/Tomcat应用服务器上的应用开发部署；
4、熟练掌握主流商业或开源数据库如DB2、Oracle、MySQL中的至少一种；
5、熟悉C/C++开发语言者优先;----加分项
6、具有快速学习和解决问题的能力；
7、熟悉软件技术文档的编写，具备良好的文档编制习惯和代码书写规范；
8、良好的团队合作精神。
9、LINUX操作系统"',
            'workyears'   => '三年以上',
            'majors'      => '计算机相关',
            'degree'      => '本科',
            'unified'     => 0,
            'salary'      => '1、一年13薪。
2、保险按照基数分档缴纳3500、5000、7000，公积金按照工资全额缴纳
3、饭补：每月400元
4、话补：转正后每月100元话补',
            'property'    => '普通职位',
            'show'        => 1,
            'closed'      => 0,
            'creater'     => 1,
            'created_at'  => date('Y-m-d H:i:s', time()),
            'modifier'    => 1,
            'updated_at'  => date('Y-m-d H:i:s', time()),
        ]);

        DB::table('projects')->insert([
            'id'         => 1,
            'sn'         => 'XM' . date('Ymdhis', time()) . sprintf('%4d', mt_rand(0, 9999)),
            'jid'        => 1,
            'cid'        => 1,
            'show'       => 1,
            'status'     => '通过',
            'creater'    => 1,
            'modifier'   => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);
    }
}
