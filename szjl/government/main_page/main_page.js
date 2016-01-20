/**
 * Created by zhangliqin on 2015/10/30.
 */
$(document).ready(function(){
    $.getJSON('energy_consumption_equival.php',function(json){
        show_consumption_equival(json);
        show_table_equival(json);    //表格当量值
    });
    $.getJSON('energy_unit.php',function(json){
        $("#unit_num").attr("value",json[0]);   //用能单位总数
        $("#point_num").attr("value",json[1]);  //采集点总数
        $("#energy").attr("value",json[2]);     //上一日总体当量用能量
    });
    $('#weight_value').click(function () {
        $(".bar li").removeClass('on');
        $(this).addClass('on');
        $("#total_consumption").show();
        $("#total_consumption2").hide();
        $.getJSON('energy_consumption_equival.php',function(json){
            show_consumption_equival(json);
            $("#energy_table").empty();
            show_table_equival(json);  // 表格当量值
        });
        $.getJSON('energy_unit.php',function(json){
            document.getElementById("yesterday_total").innerHTML = "上一日总体当量用能量：";
            $("#unit_num").attr("value",json[0]);   //用能单位总数
            $("#point_num").attr("value",json[1]);  //采集点总数
            $("#energy").attr("value",json[2]);     //上一日总体当量用能量
        });
    });
    $('#equivalent_value').click(function () {
        $(".bar li").removeClass('on');
        $(this).addClass('on');
        $("#total_consumption").hide();
        $("#total_consumption2").show();
        $.getJSON('energy_consumption_equival.php',function(json){
            show_consumption_indiff(json);
            $("#energy_table").empty();
            show_table_indiff(json);        //表格等价值
        });
        $('#water_select').click(function(){
            if($("#water_select").val() == "不含水"){
                $("#div1").attr("style","display:none");
                $("#div2").attr("style","display:block");
            }else{
                $("#div1").attr("style","display:block");
                $("#div2").attr("style","display:none");
            }
        });
        $.getJSON('energy_unit.php',function(json){
            document.getElementById("yesterday_total").innerHTML = "上一日总体等价用能量：";
            $("#unit_num").attr("value",json[0]);   //用能单位总数
            $("#point_num").attr("value",json[1]);  //采集点总数
            $("#energy").attr("value",json[3]);     //上一日总体等价用能量
        });
    });
});
//等价值
function show_table_indiff(json){
    var tr2 = "<tr><td>能耗总量</td><td>"+json[1][0]+"</td><td>"+json[1][1]+"</td><td>"+json[1][2]+"</td><td>"+json[1][3]+"</td><td>"+json[1][4]+"</td><td>"+json[1][5]+"</td><td>"+json[1][6]+"</td><td>"+json[1][7]+"</td><td>"+json[1][8]+"</td><td>"+json[1][9]+"</td><td>"+json[1][10]+"</td><td>"+json[1][11]+"</td></tr>";
    var tr3 = "<tr><td>与上月环比（%）</td><td>"+json[7][0]+"</td><td>"+json[7][1]+"</td><td>"+json[7][2]+"</td><td>"+json[7][3]+"</td><td>"+json[7][4]+"</td><td>"+json[7][5]+"</td><td>"+json[7][6]+"</td><td>"+json[7][7]+"</td><td>"+json[7][8]+"</td><td>"+json[7][9]+"</td><td>"+json[7][10]+"</td><td>"+json[7][11]+"</td></tr>";
    var tr4 = "<tr><td>与去年同比（%）</td><td>"+json[4][0]+"</td><td>"+json[4][1]+"</td><td>"+json[4][2]+"</td><td>"+json[4][3]+"</td><td>"+json[4][4]+"</td><td>"+json[4][5]+"</td><td>"+json[4][6]+"</td><td>"+json[4][7]+"</td><td>"+json[4][8]+"</td><td>"+json[4][9]+"</td><td>"+json[4][10]+"</td><td>"+json[4][11]+"</td></tr>";
    var tr5 = "<tr><td>水的消耗量</td><td>"+json[0][0]+"</td><td>"+json[0][1]+"</td><td>"+json[0][2]+"</td><td>"+json[0][3]+"</td><td>"+json[0][4]+"</td><td>"+json[0][5]+"</td><td>"+json[0][6]+"</td><td>"+json[0][7]+"</td><td>"+json[0][8]+"</td><td>"+json[0][9]+"</td><td>"+json[0][10]+"</td><td>"+json[0][11]+"</td></tr>";
    var tr6 = "<tr><td>与上月环比（%）</td><td>"+json[6][0]+"</td><td>"+json[6][1]+"</td><td>"+json[6][2]+"</td><td>"+json[6][3]+"</td><td>"+json[6][4]+"</td><td>"+json[6][5]+"</td><td>"+json[6][6]+"</td><td>"+json[6][7]+"</td><td>"+json[6][8]+"</td><td>"+json[6][9]+"</td><td>"+json[6][10]+"</td><td>"+json[6][11]+"</td></tr>";
    var tr7 = "<tr><td>与去年同比（%）</td><td>"+json[3][0]+"</td><td>"+json[3][1]+"</td><td>"+json[3][2]+"</td><td>"+json[3][3]+"</td><td>"+json[3][4]+"</td><td>"+json[3][5]+"</td><td>"+json[3][6]+"</td><td>"+json[3][7]+"</td><td>"+json[3][8]+"</td><td>"+json[3][9]+"</td><td>"+json[3][10]+"</td><td>"+json[3][11]+"</td></tr>";
    var div2 = tr2+tr3+tr4+tr5+tr6+tr7;
    $("#energy_table").append(div2);
}
//当量值
function show_table_equival(json){
    var tr2 = "<tr><td>能耗总量(tce)</td><td>"+json[2][0]+"</td><td>"+json[2][1]+"</td><td>"+json[2][2]+"</td><td>"+json[2][3]+"</td><td>"+json[2][4]+"</td><td>"+json[2][5]+"</td><td>"+json[2][6]+"</td><td>"+json[2][7]+"</td><td>"+json[2][8]+"</td><td>"+json[2][9]+"</td><td>"+json[2][10]+"</td><td>"+json[2][11]+"</td></tr>";
    var tr3 = "<tr><td>与上月环比（%）</td><td>"+json[8][0]+"</td><td>"+json[8][1]+"</td><td>"+json[8][2]+"</td><td>"+json[8][3]+"</td><td>"+json[8][4]+"</td><td>"+json[8][5]+"</td><td>"+json[8][6]+"</td><td>"+json[8][7]+"</td><td>"+json[8][8]+"</td><td>"+json[8][9]+"</td><td>"+json[8][10]+"</td><td>"+json[8][11]+"</td></tr>";
    var tr4 = "<tr><td>与去年同比（%）</td><td>"+json[5][0]+"</td><td>"+json[5][1]+"</td><td>"+json[5][2]+"</td><td>"+json[5][3]+"</td><td>"+json[5][4]+"</td><td>"+json[5][5]+"</td><td>"+json[5][6]+"</td><td>"+json[5][7]+"</td><td>"+json[5][8]+"</td><td>"+json[5][9]+"</td><td>"+json[5][10]+"</td><td>"+json[5][11]+"</td></tr>";
    var tr5 = "<tr><td>水的消耗量(tce)</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
    var tr6 = "<tr><td>与上月环比（%）</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
    var tr7 = "<tr><td>与去年同比（%）</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td><td>0</td></tr>";
    var div2 = tr2+tr3+tr4+tr5+tr6+tr7;
    $("#energy_table").append(div2);
}

//当量值
function show_consumption_equival(json){
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: ['1月', '2月', '3月', '4月', '5月','6月','7月','8月','9月','10月','11月','12月']
        },
        yAxis: {
            min: 0,
            title: {
                text: '综合能耗(tce)'
            },
            stackLabels: {
                enabled:false,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -70,
            verticalAlign: 'top',
            y: 20,
            floating: false,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            formatter: function() {
                return '<b>'+ this.x +'</b><br/>'+
                    this.series.name +': '+ this.y +'<br/>'+
                    '总量: '+ this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: '水的消耗量',
            data: [0,0,0,0,0,0,0,0,0,0,0,0]
        }, {
            name: '能源消耗量',
            data: json[2]
        }]
    });
}


//等价值
function show_consumption_indiff(json){
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: ['1月', '2月', '3月', '4月', '5月','6月','7月','8月','9月','10月','11月','12月']
        },
        yAxis: {
            min: 0,
            title: {
                text: '综合能耗(tce)'
            },
            stackLabels: {
                enabled:false,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -70,
            verticalAlign: 'top',
            y: 20,
            floating: false,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            formatter: function() {
                return '<b>'+ this.x +'</b><br/>'+
                    this.series.name +': '+ this.y +'<br/>'+
                    '总量: '+ this.point.stackTotal;
            }
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: false,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: '水的消耗量',
            data: json[0]
        }, {
            name: '能源消耗量',
            data: json[1]
        }]
    });
}

