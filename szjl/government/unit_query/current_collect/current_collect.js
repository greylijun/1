/**
 * Created by LiJun on 2015/11/24.
 */
$(document).ready(function(){
    $.getJSON("../unit_intro/enterprise_query.php",function(json){
        document.getElementById("name1").innerText = ""+json.name+"资源消耗实时曲线";
        document.getElementById("name2").innerText = ""+json.name+"上一日资源消耗表";
        document.getElementById("name3").innerText = ""+json.name+"上周资源消耗表";
    });

    //上一日资源消耗表
    $.getJSON("yesterday_source_table.php",{
        'state':'当量值'
    },function(json){
        for(var i=0;i<json[0].length;i++){
            $("#current"+i).html(json[0][i]);
        }
        for(var i=0;i<json[1].length;i++){
            $("#percent"+i).html(json[1][i]+"%");
        }
    });

    //上周资源消耗表
    $.getJSON("last_week_table.php",{
        'state':'当量值'
    },function(json){
        for(var i=0;i<json[0].length;i++){
            $("#energy"+i).html(json[0][i]);
        }
        for(var i=0;i<json[1].length;i++){
            $("#energy_per"+i).html(json[1][i]+"%");
        }
    });
    table_change_equival();
    //等价值
    $('#equivalent_value').click(function () {
        $(".bar li").removeClass('on');
        $("#select1").hide();
        $("#select2").show();
        $(".ynl").empty();
        $(".ynl").prepend("等价值/吨标煤");
        $(this).addClass('on');
        $.getJSON("yesterday_source_table.php",{
            'state':'等价值'
        },function(json){
            for(var i=0;i<json[0].length;i++){
                $("#current"+i).html(json[0][i]);
            }
            for(var i=0;i<json[1].length;i++){
                $("#percent"+i).html(json[1][i]+"%");
            }
        });
        $.getJSON("last_week_table.php",{
            'state':'等价值'
        },function(json){
            for(var i=0;i<json[0].length;i++){
                $("#energy"+i).html(json[0][i]);
            }
            for(var i=0;i<json[1].length;i++){
                $("#energy_per"+i).html(json[1][i]+"%");
            }
        });
        table_change_indiff();
    });
    //当量值
    $('#weight_value').click(function () {
        $(".bar li").removeClass('on');
        $(this).addClass('on');
        $("#select2").hide();
        $("#select1").show();
        $(".ynl").empty();
        $(".ynl").prepend("当量值/吨标煤");
        $.getJSON("yesterday_source_table.php",{
            'state':'当量值'
        },function(json){
            for(var i=0;i<json[0].length;i++){
                $("#current"+i).html(json[0][i]);
            }
            for(var i=0;i<json[1].length;i++){
                $("#percent"+i).html(json[1][i]+"%");
            }
        });
        $.getJSON("last_week_table.php",{
            'state':'当量值'
        },function(json){
            for(var i=0;i<json[0].length;i++){
                $("#energy"+i).html(json[0][i]);
            }
            for(var i=0;i<json[1].length;i++){
                $("#energy_per"+i).html(json[1][i]+"%");
            }
        });
        table_change_equival();
    });
});

function table_change_equival(){
    $("#table_one_type").empty();
    $("#table_two_type").empty();
    $("#table_three_type").empty();
    $("#table_one_type").append("<option>全部</option>");
    $("#table_two_type").append("<option>全部</option>");
    $("#table_three_type").append("<option>全部</option>");
    $.getJSON("table_select.php",function(json){
        for(var i=0;i<json.length;i++){
            $("#table_one_type").append("<option>"+json[i]+"</option>");
        }
    });
    jQuery.get("current_collect_real_time_line_one.php",{
        'table_one_type':$("#table_one_type").val()
    },function(json){
        y1 = eval("("+json+")");
    });
    $.getJSON("current_collect_real_time_one.php",{
        'table_one_type':$("#table_one_type").val()
    },function(json){
        real_data_table_equival(json);
    });
}

function table_change_indiff(){
    $("#table_one_type2").empty();
    $("#table_two_type2").empty();
    $("#table_three_type2").empty();
    $("#table_one_type2").append("<option>全部</option>");
    $("#table_two_type2").append("<option>全部</option>");
    $("#table_three_type2").append("<option>全部</option>");
    $.getJSON("table_select.php",function(json){
        for(var i=0;i<json.length;i++){
            $("#table_one_type2").append("<option>"+json[i]+"</option>");
        }
    });
    jQuery.get("current_collect_real_time_line_one.php",{
        'table_one_type':$("#table_one_type2").val()
    },function(json){
        y1 = eval("("+json+")");
    });
    $.getJSON("current_collect_real_time_one.php",{
        'table_one_type':$("#table_one_type2").val()
    },function(json){
        real_data_table_indiff(json);
    });

}


function table_change(){
    $("#table_two_type").empty();
    $("#table_three_type").empty();
    $("#table_two_type").append("<option>全部</option>");
    $("#table_three_type").append("<option>全部</option>");
    $.getJSON("table_select_two.php",{
        'table_one_type':$("#table_one_type").val()
    },function(json){
        for(var i=0;i<json.length;i++){
            $("#table_two_type").append("<option>"+json[i]+"</option>");
        }
    });
    jQuery.get("current_collect_real_time_line_one.php",{
        'table_one_type':$("#table_one_type").val()
    },function(json){
        y1 = eval("("+json+")");
    });
    $.getJSON("current_collect_real_time_one.php",{
        'table_one_type':$("#table_one_type").val()
    },function(json){
        real_data_table_equival(json);
    });
}

function two_change(){
    $("#table_three_type").empty();
    $("#table_three_type").append("<option>全部</option>");
    $.getJSON("table_select_three.php",{
        'table_one_type':$("#table_one_type").val(),
        'table_two_type':$("#table_two_type").val()
    },function(json){
        for(var i=0;i<json[0].length;i++){
            $("#table_three_type").append("<option>"+json[0][i]+"</option>");
        }
    });
    jQuery.get("current_collect_real_time_line_two.php",{
        'table_one_type':$("#table_one_type").val(),
        'table_two_type':$("#table_two_type").val()
    },function(json){
        y1 = eval("("+json+")");
    });
    $.getJSON("current_collect_real_time_two.php",{
        'table_one_type':$("#table_one_type").val(),
        'table_two_type':$("#table_two_type").val()
    },function(json){
        real_data_table_equival(json);
    });
}

function three_change(){
    jQuery.get("current_collect_real_time_line_three.php",{
        'table_one_type':$("#table_one_type").val(),
        'table_two_type':$("#table_two_type").val(),
        'table_three_type':$("#table_three_type").val()
    },function(json){
        y1 = eval("("+json+")");
    });
    $.getJSON("current_collect_real_time_three.php",{
        'table_one_type':$("#table_one_type").val(),
        'table_two_type':$("#table_two_type").val(),
        'table_three_type':$("#table_three_type").val()
    },function(json){
        real_data_table_equival(json);
    });
}

function table_change2(){
    $("#table_two_type2").empty();
    console.log(111);
    $("#table_three_type2").empty();
    $("#table_two_type2").append("<option>全部</option>");
    $("#table_three_type2").append("<option>全部</option>");
    $.getJSON("table_select_two.php",{
        'table_one_type':$("#table_one_type2").val()
    },function(json){
        for(var i=0;i<json.length;i++){
            $("#table_two_type2").append("<option>"+json[i]+"</option>");
        }
    });
    jQuery.get("current_collect_real_time_line_one.php",{
        'table_one_type':$("#table_one_type2").val()
    },function(json){
        y1 = eval("("+json+")");
    });
    $.getJSON("current_collect_real_time_one.php",{
        'table_one_type':$("#table_one_type2").val()
    },function(json){
        real_data_table_indiff(json);
    });
}

function two_change2(){
    $("#table_three_type2").empty();
    $("#table_three_type2").append("<option>全部</option>");
    $.getJSON("table_select_three.php",{
        'table_one_type':$("#table_one_type2").val(),
        'table_two_type':$("#table_two_type2").val()
    },function(json){
        for(var i=0;i<json[0].length;i++){
            $("#table_three_type2").append("<option>"+json[0][i]+"</option>");
        }
    });
    jQuery.get("current_collect_real_time_line_two.php",{
        'table_one_type':$("#table_one_type2").val(),
        'table_two_type':$("#table_two_type2").val()
    },function(json){
        y1 = eval("("+json+")");
    });
    $.getJSON("current_collect_real_time_two.php",{
        'table_one_type':$("#table_one_type2").val(),
        'table_two_type':$("#table_two_type2").val()
    },function(json){
        real_data_table_indiff(json);
    });
}

function three_change2(){
    jQuery.get("current_collect_real_time_line_three.php",{
        'table_one_type':$("#table_one_type2").val(),
        'table_two_type':$("#table_two_type2").val(),
        'table_three_type':$("#table_three_type2").val()
    },function(json){
        y1 = eval("("+json+")");
    });
    $.getJSON("current_collect_real_time_three.php",{
        'table_one_type':$("#table_one_type2").val(),
        'table_two_type':$("#table_two_type2").val(),
        'table_three_type':$("#table_three_type2").val()
    },function(json){
        real_data_table_indiff(json);
    });
}

function real_data_table_equival(json){
    Highcharts.setOptions({
        global: {
            useUTC: false
        }
    });
    var chart;
    $("#current_collect").highcharts('StockChart',{
        chart:{type: 'spline', animation: Highcharts.svg,marginRight:30,events:{
            load:function(){
                var series = this.series[0];
                setInterval(function(){
                    var x = (new Date()).getTime(),
                        y = Number(y1[0]);
                    series.addPoint([x,y],true,true);
                },300000);
            }}},
        rangeSelector: {
            buttons: [{count: 30,type: 'minute',text: '30分钟'}, {count: 1,type: 'hour',text: '1小时'}, {count: 12,type: 'hour',text: '12小时'}, {count: 24,type: 'hour',text: '24小时'}],
            inputEnabled: false,selected: 0},
        title: {text: '' },
        xAxis: {type: 'datetime',tickPixelInterval: 150},
        yAxis: {title: {text: '综合能耗(tce)'},plotLines: [{value: 0,width: 1,color: '#808080'}],min:0},
        tooltip: {enabled:true},
        legend: {enabled: false},
        exporting: {enabled: true},
        series: [{
            name: '综合能耗',
            data: (function() {
                var dataArray = [],
                    time = (new Date()).getTime(),
                    i;
                for (i =300; i>0; i--) { //初始载入数据
                    dataArray.push({
                        x: time - i * 300000,//data[1][i],
                        y: json[0][i]
                    });
                }
                return dataArray;
            })()
        }]
    });
}

function real_data_table_indiff(json){
    Highcharts.setOptions({
        global: {
            useUTC: false
        }
    });
    var chart;
    $("#current_collect").highcharts('StockChart',{
        chart:{type: 'spline', animation: Highcharts.svg,marginRight:30,events:{
            load:function(){
                var series = this.series[0];
                setInterval(function(){
                    var x = (new Date()).getTime(),
                        y = Number(y1[1]);
                    series.addPoint([x,y],true,true);
                },300000);
            }}},
        rangeSelector: {
            buttons: [{count: 30,type: 'minute',text: '30分钟'}, {count: 1,type: 'hour',text: '1小时'}, {count: 12,type: 'hour',text: '12小时'}, {count: 24,type: 'hour',text: '24小时'}],
            inputEnabled: false,selected: 0},
        title: {text: '' },
        xAxis: {type: 'datetime',tickPixelInterval: 150},
        yAxis: {title: {text: '综合能耗(tce)'},plotLines: [{value: 0,width: 1,color: '#808080'}],min:0},
        tooltip: {enabled:true},
        legend: {enabled: false},
        exporting: {enabled: true},
        series: [{
            name: '综合能耗',
            data: (function() {
                var dataArray = [],
                    time = (new Date()).getTime(),
                    i;
                for (i =300; i>0; i--) { //初始载入数据
                    dataArray.push({
                        x: time - i * 300000,//data[1][i],
                        y: json[1][i]
                    });
                }
                return dataArray;
            })()
        }]
    });
}
