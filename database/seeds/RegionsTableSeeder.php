<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 北京
        DB::table('regions')->insert(['code' => '110000', 'name' => '北京', 'type' =>1, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110100', 'name' => '北京', 'parent' => '110000', 'type' => 2, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110101', 'name' => '东城区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110102', 'name' => '西城区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110105', 'name' => '朝阳区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110106', 'name' => '丰台区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110107', 'name' => '石景山区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110108', 'name' => '海淀区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110109', 'name' => '门头沟区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110111', 'name' => '房山区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110112', 'name' => '通州区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110113', 'name' => '顺义区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110114', 'name' => '昌平区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110115', 'name' => '大兴区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110116', 'name' => '怀柔区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110117', 'name' => '平谷区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110228', 'name' => '密云区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '110229', 'name' => '延庆区', 'parent' => '110100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        // 天津
        DB::table('regions')->insert(['code' => '120000', 'name' => '天津', 'type' => 1, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120100', 'name' => '天津', 'parent' => '120000', 'type' => 2, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120101', 'name' => '和平区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120102', 'name' => '河东区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120103', 'name' => '河西区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120104', 'name' => '南开区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120105', 'name' => '河北区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120106', 'name' => '红桥区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120110', 'name' => '东丽区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120111', 'name' => '西青区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120112', 'name' => '津南区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120113', 'name' => '北辰区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120114', 'name' => '武清区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120115', 'name' => '宝坻区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120116', 'name' => '滨海新区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120221', 'name' => '宁河区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120223', 'name' => '静海区', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '120225', 'name' => '蓟县', 'parent' => '120100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        // 河北
        DB::table('regions')->insert(['code' => '130000', 'name' => '河北', 'type' => 1, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130100', 'name' => '石家庄', 'parent' => '130000', 'type' => 2, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130102', 'name' => '长安区', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130103', 'name' => '桥东区', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130104', 'name' => '桥西区', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130105', 'name' => '新华区', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130107', 'name' => '井陉矿区', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130108', 'name' => '裕华区', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130109', 'name' => '藁城区', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130110', 'name' => '鹿泉区', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130111', 'name' => '栾城区', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130121', 'name' => '井陉县', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130123', 'name' => '正定县', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130125', 'name' => '行唐县', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130126', 'name' => '灵寿县', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130127', 'name' => '高邑县', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130128', 'name' => '深泽县', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130129', 'name' => '赞皇县', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130130', 'name' => '无极县', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130131', 'name' => '平山县', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130132', 'name' => '元氏县', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130133', 'name' => '赵县', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130181', 'name' => '辛集市', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130183', 'name' => '晋州市', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130184', 'name' => '新乐市', 'parent' => '130100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        // 唐山市
        DB::table('regions')->insert(['code' => '130200', 'name' => '唐山', 'parent' => '130000', 'type' => 2, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130202', 'name' => '路南区', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130203', 'name' => '路北区', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130204', 'name' => '古冶区', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130205', 'name' => '开平区', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130207', 'name' => '丰南区', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130208', 'name' => '丰润区', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130223', 'name' => '滦县', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130224', 'name' => '滦南县', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130225', 'name' => '乐亭县', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130227', 'name' => '迁西县', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130229', 'name' => '玉田县', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130230', 'name' => '曹妃甸区', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130281', 'name' => '遵化市', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130283', 'name' => '迁安市', 'parent' => '130200', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        // 秦皇岛
        DB::table('regions')->insert(['code' => '130300', 'name' => '秦皇岛', 'parent' => '130000', 'type' => 2, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130302', 'name' => '海港区', 'parent' => '130300', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130303', 'name' => '山海关区', 'parent' => '130300', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130304', 'name' => '北戴河区', 'parent' => '130300', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130321', 'name' => '青龙县', 'parent' => '130300', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130322', 'name' => '昌黎县', 'parent' => '130300', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130323', 'name' => '抚宁县', 'parent' => '130300', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130324', 'name' => '卢龙县', 'parent' => '130300', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        // 邯郸
        DB::table('regions')->insert(['code' => '130400', 'name' => '邯郸', 'parent' => '130000', 'type' => 2, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130402', 'name' => '邯山区', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130403', 'name' => '丛台区', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130404', 'name' => '复兴区', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130406', 'name' => '峰峰矿区', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130421', 'name' => '邯郸县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130423', 'name' => '临漳县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130424', 'name' => '成安县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130425', 'name' => '大名县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130426', 'name' => '涉县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130427', 'name' => '磁县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130428', 'name' => '肥乡县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130429', 'name' => '永年县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130430', 'name' => '邱县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130431', 'name' => '鸡泽县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130432', 'name' => '广平县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130433', 'name' => '馆陶县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130434', 'name' => '魏县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130435', 'name' => '曲周县', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130481', 'name' => '武安市', 'parent' => '130400', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        // 邢台
        DB::table('regions')->insert(['code' => '130500', 'name' => '邢台', 'parent' => '130000', 'type' => 2, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130502', 'name' => '桥东区', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130503', 'name' => '桥西区', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130521', 'name' => '邢台县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130522', 'name' => '临城县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130523', 'name' => '内丘县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130524', 'name' => '柏乡县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130525', 'name' => '隆尧县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130526', 'name' => '任县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130527', 'name' => '南和县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130528', 'name' => '宁晋县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130529', 'name' => '巨鹿县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130530', 'name' => '新河县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130531', 'name' => '广宗县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130532', 'name' => '平乡县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130533', 'name' => '威县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130534', 'name' => '清河县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130535', 'name' => '临西县', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130581', 'name' => '南宫市', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130582', 'name' => '沙河市', 'parent' => '130500', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        // 保定
        DB::table('regions')->insert(['code' => '130600', 'name' => '保定', 'parent' => '130000', 'type' => 2, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130602', 'name' => '竞秀区', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130603', 'name' => '莲池区', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130604', 'name' => '南市区', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130621', 'name' => '满城区', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130622', 'name' => '清苑区', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130623', 'name' => '涞水县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130624', 'name' => '阜平县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130625', 'name' => '徐水区', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130626', 'name' => '定兴县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130627', 'name' => '唐县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130628', 'name' => '高阳县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130629', 'name' => '容城县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130630', 'name' => '涞源县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130631', 'name' => '望都县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130632', 'name' => '安新县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130633', 'name' => '易县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130634', 'name' => '曲阳县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130635', 'name' => '蠡县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130636', 'name' => '顺平县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130637', 'name' => '博野县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130638', 'name' => '雄县', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130681', 'name' => '涿州市', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130682', 'name' => '定州市', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130683', 'name' => '安国市', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130684', 'name' => '高碑店市', 'parent' => '130600', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        // 张家口
        DB::table('regions')->insert(['code' => '130700', 'name' => '张家口', 'parent' => '130000', 'type' => 2, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130702', 'name' => '桥东区', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130703', 'name' => '桥西区', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130705', 'name' => '宣化区', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130706', 'name' => '下花园区', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130721', 'name' => '宣化县', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130722', 'name' => '张北县', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130723', 'name' => '康保县', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130724', 'name' => '沽源县', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130725', 'name' => '尚义县', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130726', 'name' => '蔚县', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130727', 'name' => '阳原县', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130728', 'name' => '怀安县', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130729', 'name' => '万全县', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130730', 'name' => '怀来县', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130731', 'name' => '涿鹿县', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130732', 'name' => '赤城县', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130733', 'name' => '崇礼县', 'parent' => '130700', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()),  'updated_at' =>date('Y-m-d H:i:s', time())]);
        // 承德
        DB::table('regions')->insert(['code' => '130800', 'name' => '承德', 'parent' => '130000', 'type' => 2, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130802', 'name' => '双桥区', 'parent' => '130800', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130803', 'name' => '双滦区', 'parent' => '130800', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130804', 'name' => '鹰手营子矿区', 'parent' => '130800', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130821', 'name' => '承德县', 'parent' => '130800', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130822', 'name' => '兴隆县', 'parent' => '130800', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130823', 'name' => '平泉县', 'parent' => '130800', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130824', 'name' => '滦平县', 'parent' => '130800', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130825', 'name' => '隆化县', 'parent' => '130800', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130826', 'name' => '丰宁满族自治县', 'parent' => '130800', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130827', 'name' => '宽城县', 'parent' => '130800', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130828', 'name' => '围场县', 'parent' => '130800', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        // 沧州
        DB::table('regions')->insert(['code' => '130900', 'name' => '沧州', 'parent' => '130000', 'type' => 2, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130902', 'name' => '新华区', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130903', 'name' => '运河区', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130921', 'name' => '沧县', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130922', 'name' => '青县', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130923', 'name' => '东光县', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130924', 'name' => '海兴县', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130925', 'name' => '盐山县', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130926', 'name' => '肃宁县', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130927', 'name' => '南皮县', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130928', 'name' => '吴桥县', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130929', 'name' => '献县', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130930', 'name' => '孟村回族自治县', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130981', 'name' => '泊头市', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130982', 'name' => '任丘市', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130983', 'name' => '黄骅市', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '130984', 'name' => '河间市', 'parent' => '130900', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        // 廊坊
        DB::table('regions')->insert(['code' => '131000', 'name' => '廊坊', 'parent' => '130000', 'type' => 2, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131002', 'name' => '安次区', 'parent' => '131000', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131003', 'name' => '广阳区', 'parent' => '131000', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131022', 'name' => '固安县', 'parent' => '131000', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131023', 'name' => '永清县', 'parent' => '131000', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131024', 'name' => '香河县', 'parent' => '131000', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131025', 'name' => '大城县', 'parent' => '131000', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131026', 'name' => '文安县', 'parent' => '131000', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131028', 'name' => '大厂回族自治县', 'parent' => '131000', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131081', 'name' => '霸州市', 'parent' => '131000', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131082', 'name' => '三河市', 'parent' => '131000', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        // 衡水
        DB::table('regions')->insert(['code' => '131100', 'name' => '衡水', 'parent' => '130000', 'type' => 2, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131102', 'name' => '桃城区', 'parent' => '131100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131121', 'name' => '枣强县', 'parent' => '131100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131122', 'name' => '武邑县', 'parent' => '131100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131123', 'name' => '武强县', 'parent' => '131100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131124', 'name' => '饶阳县', 'parent' => '131100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131125', 'name' => '安平县', 'parent' => '131100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131126', 'name' => '故城县', 'parent' => '131100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131127', 'name' => '景县', 'parent' => '131100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131128', 'name' => '阜城县', 'parent' => '131100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131181', 'name' => '冀州市', 'parent' => '131100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('regions')->insert(['code' => '131182', 'name' => '深州市', 'parent' => '131100', 'type' => 3, 'created_at' => date('Y-m-d H:i:s', time()), 'updated_at' => date('Y-m-d H:i:s', time())]);
    }
}
