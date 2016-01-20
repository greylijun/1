/**
 * Created by LiJun on 2015/11/5.
 */
$(document).ready(function(){
    $.getJSON('distribution/energymap_unit.php',{
        area:"全市"
    },function(json){
        $("#total_energy_unit").attr("value",json[0]);             //用能单位总数
        $("#total_collecting_point").attr("value",json[1]);        //采集点总数
        $("#last_energy").attr("value",json[2]);                   //上一日总体当量用能量
    });
    $('#area').change(function(){
        $.getJSON('distribution/energymap_unit.php',{
            area:$('#area').val()
        },function(json){
            $("#total_energy_unit").attr("value",json[0]);             //用能单位总数
            $("#total_collecting_point").attr("value",json[1]);        //采集点总数
            $("#last_energy").attr("value",json[2]);                   //上一日总体当量用能量
        });
        if($("#area").val() == "全市"){
            $("#map").empty();
            var map = new BMap.Map("map");
            var cityName = "苏州市";
            initMap(map, cityName);
        }
        if($("#area").val() == "姑苏区"){
            $("#map").empty();
            gusuqu();
        }
        if($('#area').val() == "园区"){
            $("#map").empty();
            yuanqu();
        }
        if($('#area').val() == "高新区"){
            $("#map").empty();
            var map = new BMap.Map("map");
            var cityName = "虎丘区";
            gaoxinqu(map, cityName);
        }
        if($('#area').val() == "吴中区"){
            $("#map").empty();
            wuzhongqu();
        }
        if($('#area').val() == "相城区"){
            $("#map").empty();
            var map = new BMap.Map("map");
            var cityName = "相城区";
            xiangchengqu(map, cityName);
        }
        if($('#area').val() == "吴江区"){
            $("#map").empty();
            var map = new BMap.Map("map");
            var cityName = "吴江市";
            wujiangqu(map,cityName);
        }
        if($('#area').val() == "昆山市"){
            $("#map").empty();
            var map = new BMap.Map("map");
            var cityName = "昆山市";
            kunshan(map, cityName);
        }
        if($('#area').val() == "常熟市"){
            $("#map").empty();
            var map = new BMap.Map("map");
            var cityName = "常熟市";
            changshu(map, cityName);
        }
        if($('#area').val() == "张家港市"){
            $("#map").empty();
            var map = new BMap.Map("map");
            var cityName = "张家港市";
            zhangjiagang(map, cityName);
        }
        if($('#area').val() == "太仓市"){
            $("#map").empty();
            var map = new BMap.Map("map");
            var cityName = "太仓市";
            taicang(map, cityName);
        }
    });
    $('#a_1').click(function () {
        var map = new BMap.Map("energy_consumption");
        var cityName = "苏州市";
        initMap5(map, cityName);
        $(".area li").removeClass('active');
        $(this).addClass('active');
    });
    $('#a_2').click(function () {
        $("#energy_consumption").empty();
        gusuqu1();
        $(".area li").removeClass('active');
        $(this).addClass('active');
    });
    $('#a_3').click(function () {
        $("#energy_consumption").empty();
        yuanqu1();
        $(".area li").removeClass('active');
        $(this).addClass('active');
    });
    $('#a_4').click(function () {
        $("#energy_consumption").empty();
        var map = new BMap.Map("energy_consumption");
        var cityName = "虎丘区";
        gaoxinqu1(map, cityName);
        $(".area li").removeClass('active');
        $(this).addClass('active');
    });
    $('#a_5').click(function () {
        $("#energy_consumption").empty();
        wuzhongqu1();
        $(".area li").removeClass('active');
        $(this).addClass('active');
    });
    $('#a_6').click(function () {
        $("#energy_consumption").empty();
        var map = new BMap.Map("energy_consumption");
        var cityName = "相城区";
        xiangchengqu1(map, cityName);
        $(".area li").removeClass('active');
        $(this).addClass('active');
    });
    $('#a_7').click(function () {
        $("#energy_consumption").empty();
        var map = new BMap.Map("energy_consumption");
        var cityName = "吴江市";
        wujiangqu1(map,cityName);
        $(".area li").removeClass('active');
        $(this).addClass('active');
    });
    $('#a_8').click(function () {
        $("#energy_consumption").empty();
        var map = new BMap.Map("energy_consumption");
        var cityName = "昆山市";
        kunshan1(map, cityName);
        $(".area li").removeClass('active');
        $(this).addClass('active');
    });
    $('#a_9').click(function () {
        $("#energy_consumption").empty();
        var map = new BMap.Map("energy_consumption");
        var cityName = "常熟市";
        changshu1(map, cityName);
        $(".area li").removeClass('active');
        $(this).addClass('active');
    });
    $('#a_10').click(function () {
        $("#energy_consumption").empty();
        var map = new BMap.Map("energy_consumption");
        var cityName = "张家港市";
        zhangjiagang1(map, cityName);
        $(".area li").removeClass('active');
        $(this).addClass('active');
    });
    $('#a_11').click(function () {
        $("#energy_consumption").empty();
        var map = new BMap.Map("energy_consumption");
        var cityName = "太仓市";
        taicang1(map, cityName);
        $(".area li").removeClass('active');
        $(this).addClass('active');
    });
});