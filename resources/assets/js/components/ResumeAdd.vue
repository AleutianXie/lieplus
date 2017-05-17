<template>
<div class="container_fluid">
<!-- 新建简历--开始 -->
<form class="form-horizontal" id="validation-form" method="post">
    <input type="hidden" name="_token" :value="token" />
    <div class="form-group">
        <label class="control-label col-xs-6 col-sm-2 no-padding-right" for="name">姓名:</label>

        <div class="col-xs-6 col-sm-2">
            <div class="clearfix">
                <input type="text" name="name" id="name" value="" required />
            </div>
        </div>

        <label class="control-label col-xs-6 col-sm-2 no-padding-right">性别:</label>

        <div class="col-xs-6 col-sm-2">
            <label v-for="g in item.gender" class="control-label line-height-1 blue">
                <input name="gender" type="radio" class="ace" :value="g.id"/>
                <span class="lbl"> {{ g.text }}</span>
                &nbsp;
            </label>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-6 col-sm-2 no-padding-right" for="phone">手机:</label>

        <div class="col-xs-6 col-sm-2">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-phone"></i>
                </span>

                <input type="tel" id="mobile" name="mobile"  required pattern="1(3|4|5|7|8)[0-9]{9}"/>
<!--                 <span class="red">
                    {{ $errors->first('mobile') }}
                </span> -->
            </div>
        </div>

        <label class="control-label col-xs-6 col-sm-2 no-padding-right" for="email">邮箱:</label>

        <div class="col-xs-6 col-sm-2">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-envelope"></i>
                </span>

                <input type="email" name="email" id="email" required />
<!--                 <span class="red">
                    {{ $errors->first('email') }}
                </span> -->
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-6 col-sm-2 no-padding-right" for="degree">学历:</label>

        <div class="col-xs-6 col-sm-2">
            <div class="clearfix">
                <select name="degree" id="degree">
                    <option v-for="d in item.degree" :value="d.id">{{ d.text }}</option>
                </select>
            </div>
        </div>

        <label class="control-label col-xs-6 col-sm-2 no-padding-right" for="state">城市:</label>

        <div class="col-xs-6 col-sm-6">
            <select id="province" name="province" required>
                <option></option>
            </select>
            <select id="city" name="city" required>
                <option></option>
            </select>
            <select id="county" name="county" required>
                <option></option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-6 col-sm-2 no-padding-right" for="birthdate">生日:</label>

        <div class="col-xs-6 col-sm-3">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-calendar"></i>
                </span>

                <input type="date" name="birthdate" id="birthdate" value="" required max=""/>
<!--                 <span class="red">
                    {{ $errors->first('birthdate') }}
                </span> -->
            </div>
        </div>

        <label class="control-label col-xs-12 col-sm-1 no-padding-right" for="startworkdate">开始工作:</label>

        <div class="col-xs-6 col-sm-2">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="ace-icon fa fa-calendar"></i>
                </span>

                <input type="date" name="startworkdate" id="startworkdate" value="" max="" min="" required />
<!--                 <span class="red">
                    {{ $errors->first('startworkdate') }}
                </span> -->
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-6 col-sm-2 no-padding-right" for="servicestatus">当前状态:</label>

        <div class="col-xs-6 col-sm-2">
            <div class="clearfix">
                <select name="servicestatus" id="servicestatus">
                    <option v-for="s in item.servicestatus" :value="s.id">{{ s.text }}</option>
                </select>
            </div>
        </div>

        <label class="control-label col-xs-6 col-sm-2 no-padding-right" for="industry">当前行业:</label>

        <div class="col-xs-6 col-sm-2">
            <div class="clearfix">
                <input type="text" name="industry" id="industry" value="" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-6 col-sm-2 no-padding-right" for="position">当前职位:</label>

        <div class="col-xs-6 col-sm-2">
            <div class="clearfix">
                <input type="text" name="position" id="position" value="" />
            </div>
        </div>

        <label class="control-label col-xs-6 col-sm-2 no-padding-right" for="salary">期望薪资:</label>

        <div class="col-xs-6 col-sm-2">
            <div class="clearfix">
                <select name="salary" id="salary" class="col-xs-12 col-sm-4">
                    <option v-for="s in item.salary" :value="s.id">{{ s.text }}</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="joblibaray">职位简历库:</label>

        <div class="col-xs-6 col-sm-6">
            <div class="clearfix">
                <select name="joblibaray" id="joblibaray">
                <option></option>
                <option v-for="j in item.salary" :value="j.id">{{ j.text }}</option>
                </select>
            </div>
        </div>
    </div>

</form>
    <!-- 新建简历--结束 -->
</div>

</template>

<style scoped>
    @import "~select2/dist/css/select2.css";
</style>

<script>
require('select2')
//require('bootstrap-datepicker')


export default {
  data() {
    return {
    }
  },
  props: ['resume', 'old', 'token'],
  computed: {
    item() {
        return JSON.parse(this.resume)
    }
  },
  mounted() {
    $('#degree').select2({
        minimumResultsForSearch: Infinity,
        width: 160
    });
    var item = JSON.parse(this.resume)
    var provinces = [];
    //alert(item.provinces);
    $.each(item.provinces, function(k, v) {
        provinces.push({id: k, text: v});
    });

    var cities = [];
    $.each(item.cities, function(key, value) {
        cities[key] = [];
        $.each(value, function(k, v){
            cities[key].push({id: k, text: v});
        });
    });

    var counties = [];
    $.each(item.counties, function(key,value) {
        counties[key] = [];
        $.each(value, function(k, v) {
            counties[key].push({id: k, text: v});
        });
    });

    $('#province').select2({
        data: provinces,
        placeholder: '请选择省',
        width: 140
    });

    $('#city').select2({
        placeholder: '请选择市',
        width: 140
    });

    $('#county').select2({
        placeholder: '请选择县',
        width: 140
    });

    $('#province').on('select2:select', function(evt) {
        $('#city').find("option").remove();
        $('#city').select2({
            data: cities[$(this).val()],
            width: 140
        });
        $('#county').find("option").remove();
        $('#county').select2({
            data: counties[$('#city').val()],
            width: 140
        });
    });

    $('#city').on('select2:select', function (evt) {
        $('#county').find("option").remove();
        $('#county').select2({
            data: counties[$(this).val()],
            width: 140
        });
    });

    // $('#birthdate').datepicker({
    //     format: 'yyyy-mm-dd',
    // });

    // $('#startworkdate').datepicker({
    //     format: 'yyyy-mm-dd',
    // });

    $('#servicestatus').select2({
        minimumResultsForSearch: Infinity,
        width: 140
    });

    $('#salary').select2({
        minimumResultsForSearch: Infinity,
        width: 140
    });

    $('#joblibaray').select2({
        placeholder: "请选择职位简历库",
        allowClear: true,
        width: 200
    });
  }
}

</script>
