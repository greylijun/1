/**
 * Created by LiJun on 2015/12/4.
 */
$(document).ready(function(){
    $.getJSON("../unit_intro/enterprise_query.php",function(json){
        document.getElementById("name1").innerText = ""+json.name+"资源消耗实时曲线";
        document.getElementById("name2").innerText = ""+json.name+"上月资源消耗饼状图";
        document.getElementById("name3").innerText = ""+json.name+"上个月资源消耗表";
    });
    $.getJSON("last_month_data.php",{
        'state':'当量值'
    },function(json){
       for(var i=0;i<json[0].length;i++){
           $("#real"+i).html(json[0][i]);
       }
       for(var i=0;i<json[1].length;i++){
           $("#per"+i).html(json[1][i]+"%");
       }
       showpie(json);
   });
    jQuery.get("real_data_equival_line.php",function(json){
       y1 = eval("("+json+")");
    });
    $.getJSON("real_data_equival.php",function(json){
        real_data_table_equival(json);
    });

    $("#weight_value").click(function(){
        $(".bar li").removeClass('on');
        $(this).addClass('on');
        $(".ynl").empty();
        $(".ynl").prepend("当量值/吨标煤");
        $.getJSON("real_data_equival.php",function(json){
            real_data_table_equival(json);
        });
        $.getJSON("last_month_data.php",{
            'state':'当量值'
        },function(json){
            for(var i=0;i<json[0].length;i++){
                $("#real"+i).html(json[0][i]);
            }
            for(var i=0;i<json[1].length;i++){
                $("#per"+i).html(json[1][i]+"%");
            }
            showpie(json);
        });
    });
    $("#equivalent_value").click(function(){
        $(".bar li").removeClass('on');
        $(this).addClass('on');
        $(".ynl").empty();
        $(".ynl").prepend("等价值/吨标煤");
        $.getJSON("real_data_equival.php",function(json){
            real_data_table_indiff(json);
        });
        $.getJSON("last_month_data.php",{
            'state':'等价值'
        },function(json){
            for(var i=0;i<json[0].length;i++){
                $("#real"+i).html(json[0][i]);
            }
            for(var i=0;i<json[1].length;i++){
                $("#per"+i).html(json[1][i]+"%");
            }
            showpie(json);
        });
    });
});

function showpie(json){
    $('#pie').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.3f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.3f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: '资源消耗饼状图',
            data: [
                ['水', json[1][0]],
                ['电', json[1][1]],
                ['煤', json[1][2]],
                //{
                //    name: 'Chrome',
                //    y: 12.8,
                //    sliced: true,
                //    selected: true
                //},
                ['油',   json[1][3]],
                ['蒸汽',  json[1][4]],
                ['天然气', json[1][5]],
                ['冷量',  json[1][6]]
            ]
        }]
    });
}

function real_data_table_equival(json){
    Highcharts.setOptions({
        global: {
            useUTC: false
        }
    });
    var chart;
    $("#real_data").highcharts('StockChart',{
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
    $("#real_data").highcharts('StockChart',{
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