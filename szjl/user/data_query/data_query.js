/**
 * Created by zhangliqin on 2015/11/3.
 */
//二级菜单切换
$('#history_data').click(function () {
    $(".menu li ").removeClass('on');
    $(this).addClass('on');
    $("#dq_1").show();
    $("#dq_2").hide();
});
$('#data_analysis').click(function () {
    $(".menu li ").removeClass('on');
    $(this).addClass('on');
    $("#dq_1").hide();
    $("#dq_2").show();
});
//报表切换
$('#year').click(function () {
    $(".menu_bar li a").removeClass('on');
    $(this).addClass('on');
    $(".year_report").show();
    $(".season_report_s").hide();
    $(".season_report_e").hide();
    $(".month_report_s").hide();
    $(".week_report_s").hide();
    $(".day_report_s").hide();
    $(".month_report_e").hide();
    $(".week_report_e").hide();
    $(".day_report_e").hide();
    $(".hour_report").hide();
    $('.limit').show();
});
$('#season').click(function () {
    $(".menu_bar li a").removeClass('on');
    $(this).addClass('on');
    $(".year_report").show();
    $(".season_report_s").show();
    $(".season_report_e").show();
    $(".month_report_s").hide();
    $(".week_report_s").hide();
    $(".day_report_s").hide();
    $(".month_report_e").hide();
    $(".week_report_e").hide();
    $(".day_report_e").hide();
    $(".hour_report").hide();
    $('.limit').hide();
});
$('#month').click(function () {
    $(".menu_bar li a").removeClass('on');
    $(this).addClass('on');
    $(".year_report").show();
    $(".season_report_s").hide();
    $(".season_report_e").hide();
    $(".month_report_s").show();
    $(".week_report_s").hide();
    $(".day_report_s").hide();
    $(".month_report_e").show();
    $(".week_report_e").hide();
    $(".day_report_e").hide();
    $(".hour_report").hide();
    $('.limit').hide();
});
$('#week').click(function () {
    $(".menu_bar li a").removeClass('on');
    $(this).addClass('on');
    $(".year_report").show();
    $(".season_report_s").hide();
    $(".season_report_e").hide();
    $(".month_report_s").hide();
    $(".week_report_s").show();
    $(".day_report_s").hide();
    $(".month_report_e").hide();
    $(".week_report_e").show();
    $(".day_report_e").hide();
    $(".hour_report").hide();
    $('.limit').hide();
});
$('#day').click(function () {
    $(".menu_bar li a").removeClass('on');
    $(this).addClass('on');
    $(".year_report").hide();
    $(".season_report_s").hide();
    $(".season_report_e").hide();
    $(".month_report_s").hide();
    $(".week_report_s").hide();
    $(".day_report_s").show();
    $(".month_report_e").hide();
    $(".week_report_e").hide();
    $(".day_report_e").show();
    $(".hour_report").hide();
    $('.limit').hide();
});
$('#hour').click(function () {
    $(".menu_bar li a").removeClass('on');
    $(this).addClass('on');
    $(".year_report").hide();
    $(".season_report_s").hide();
    $(".season_report_e").hide();
    $(".month_report_s").hide();
    $(".week_report_s").hide();
    $(".day_report_s").hide();
    $(".month_report_e").hide();
    $(".week_report_e").hide();
    $(".day_report_e").hide();
    $(".hour_report").show();
    $('.limit').hide();
});

//当量和等价切换
$('#equivalent_value').click(function () {
    $(".bar li").removeClass('on');
    $(this).addClass('on');
});
$('#weight_value').click(function () {
    $(".bar li").removeClass('on');
    $(this).addClass('on');
});


$(document).ready(function(){
    $.getJSON(
		"LoadDataQuery.php",
		function(data){
			ResourceConsumptionColumn(data[0],data[1]);
            ResourceConsumptionPie(data[2]);
            SourceTable(data[3],data[4]);
		}
	)
})

$("#button").click(function(){
    var str = $("#report .on").text();
    var ReportForm = str.substr(str.length-3);
    if(ReportForm=="年报表"){
        var YearValue = $("#QueryYear").val();
        //var Type = $("input[type='radio']:checked").val();
        if($("#change_value .on").text()=="当量值"){
            var ChangeValue = "daily_equival_value";
        }else{
            var ChangeValue = "daily_indiff_value";
        }
        QueryYear(YearValue,ChangeValue);
    }else if(ReportForm=="季报表"){
        var YearValue = $("#QueryYear").val();
        //var Type = $("input[type='radio']:checked").val();
        var SeasonStart = $("#QuerySeasonStart").val();
        var SeasonEnd = $("#QuerySeasonEnd").val();
        if($("#change_value .on").text()=="当量值"){
            var ChangeValue = "daily_equival_value";
        }else{
            var ChangeValue = "daily_indiff_value";
        }
        QuerySeason(YearValue,SeasonStart,SeasonEnd,ChangeValue);
    }else if(ReportForm=="月报表"){
        var YearValue = $("#QueryYear").val();
        //var Type = $("input[type='radio']:checked").val();
        var MonthStart = $("#QueryMonthStart").val();
        var MonthEnd = $("#QueryMonthEnd").val();
        if($("#change_value .on").text()=="当量值"){
            var ChangeValue = "daily_equival_value";
        }else{
            var ChangeValue = "daily_indiff_value";
        }
        QueryMonth(YearValue,MonthStart,MonthEnd,ChangeValue);
    }else if(ReportForm=="周报表"){
        var YearValue = $("#QueryYear").val();
        //var Type = $("input[type='radio']:checked").val();
        var WeekStart = $("#QueryWeekStart").val();
        var WeekEnd = $("#QueryWeekEnd").val();
        if($("#change_value .on").text()=="当量值"){
            var ChangeValue = "daily_equival_value";
        }else{
            var ChangeValue = "daily_indiff_value";
        }
        QueryWeek(YearValue,WeekStart,WeekEnd,ChangeValue);
    }else if(ReportForm=="日报表"){
        //var Type = $("input[type='radio']:checked").val();
        var DayStart = $("#QueryDayStart").val();
        var DayEnd = $("#QueryDayEnd").val();
        if($("#change_value .on").text()=="当量值"){
            var ChangeValue = "daily_equival_value";
        }else{
            var ChangeValue = "daily_indiff_value";
        }
        QueryDay(DayStart,DayEnd,ChangeValue);
    }else if(ReportForm=="时报表"){
        //var Type = $("input[type='radio']:checked").val();
        var HourStart = $("#QueryHourStart").val();
        var HourEnd = $("#QueryHourEnd").val();
        if($("#change_value .on").text()=="当量值"){
            var ChangeValue = "daily_equival_value";
        }else{
            var ChangeValue = "daily_indiff_value";
        }
        QueryHour(HourStart,HourEnd,ChangeValue);
    }else{
        alert($("#report .active").text());
    }
	
})

function QueryYear(yearValue,changeValue){
    if(yearValue==""){
        alert("请输入年份！");
        return false;
    }
    $.getJSON(
        "HistoryQueryYear.php",
        {yearValue:yearValue,changeValue:changeValue},function(data){
            ResourceConsumptionColumn(data[0],data[1]);
            ResourceConsumptionPie(data[2]);
            SourceTable(data[3],data[4]);
        }
    )
}

function QuerySeason(yearValue,seasonStart,seasonEnd,changeValue){
    if(yearValue==""){alert("请输入年份！");return false;}
    if(seasonStart==""){alert("请输入起始季度！");return false;}
    if(seasonEnd==""){alert("请输入结束季度！");return false;}
    if(seasonStart>seasonEnd){alert("起始季度不能大于结束季度！");return false;}
    $.getJSON(
        "HistoryQuerySeason.php",
        {yearValue:yearValue,seasonStart:seasonStart,seasonEnd:seasonEnd,changeValue:changeValue},function(data){
            ResourceConsumptionColumn(data[0],data[1]);
            ResourceConsumptionPie(data[2]);
            SourceTable(data[3],data[4]);
        }
    )
}

function QueryMonth(yearValue,monthStart,monthEnd,changeValue){
    //alert(monthStart);
    //alert(monthEnd);
    if(yearValue==""){alert("请输入年份！");return false;}
    if(monthStart==""){alert("请输入起始月份！");return false;}
    if(monthEnd==""){alert("请输入结束月份！");return false;}
    if(monthStart>monthEnd){alert("起始月份不能大于结束月份！");return false;}
    $.getJSON(
        "HistoryQueryMonth.php",
        {yearValue:yearValue,monthStart:monthStart,monthEnd:monthEnd,changeValue:changeValue},function(data){
            ResourceConsumptionColumn(data[0],data[1]);
            ResourceConsumptionPie(data[2]);
            SourceTable(data[3],data[4]);
        }
    )
}

function QueryWeek(yearValue,weekStart,weekEnd,changeValue){
    if(yearValue==""){alert("请输入年份！");return false;}
    if(weekStart==""){alert("请输入起始月份！");return false;}
    if(weekEnd==""){alert("请输入结束月份！");return false;}
    if(weekStart>weekEnd){alert("起始周不能大于结束周！");return false;}
    $.getJSON(
        "HistoryQueryWeek.php",
        {yearValue:yearValue,weekStart:weekStart,weekEnd:weekEnd,changeValue:changeValue},function(data){
            ResourceConsumptionColumn(data[0],data[1]);
            ResourceConsumptionPie(data[2]);
            SourceTable(data[3],data[4]);
        }
    )
}

function QueryDay(dayStart,dayEnd,changeValue){
    if(dayStart==""){alert("请输入起始月份！");return false;}
    if(dayEnd==""){alert("请输入结束月份！");return false;}
    if(dayStart>dayEnd){alert("起始日期不能早于结束日期！");return false;}
    $.getJSON(
        "HistoryQueryDay.php",
        {dayStart:dayStart,dayEnd:dayEnd,changeValue:changeValue},function(data){
            ResourceConsumptionColumn(data[0],data[1]);
            ResourceConsumptionPie(data[2]);
            SourceTable(data[3],data[4]);
        }
    )
}

function QueryHour(hourStart,hourEnd,changeValue){
    if(hourStart==""){alert("请输入起始月份！");return false;}
    if(hourEnd==""){alert("请输入结束月份！");return false;}
    if(dayStart>dayEnd){alert("起始日期不能早于结束日期！");return false;}
    $.getJSON(
        "HistoryQueryHour.php",
        {hourStart:hourStart,hourEnd:hourEnd,changeValue:changeValue},function(data){
            ResourceConsumptionColumn(data[0],data[1]);
            ResourceConsumptionPie(data[2]);
            SourceTable(data[3],data[4]);
        }
    )
}

function ResourceConsumptionColumn(data1,data2){
    $('#ResourceConsumptionColumn').highcharts({
        chart: {type: 'column'},
        title: {text: ''},
        xAxis: {categories:data1},
        yAxis: {min: 0,title: {text: '资源消耗图'}},
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.3f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        legend: {
            enabled: false
        },
        plotOptions: {column: {pointPadding: 0.2,borderWidth: 0}},
        series: [{
            name: '资源消耗',
            data: data2
        }]
    });
}

function ResourceConsumptionPie(data){
    $('#ResourceConsumptionPie').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '资源消耗饼图'
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
            name: '资源消耗',
            data:data
        }]
    });
}

function SourceTable(data1,data2){
    $("#SourceTable").empty();
    var str = "<tr><td>资源类型</td><td>用能量/吨标煤</td><td>限额/吨标煤</td><td>占消耗总量百分比</td></tr>";
        str+= "<tr><td>水</td>      <td>"+data1[0]+"</td><td>"+data1[9]+"</td>              <td>"+data2[0]+"%</td></tr>";
        str+= "<tr><td>电</td>      <td>"+data1[1]+"</td><td rowspan='6'>"+data1[10]+"</td> <td>"+data2[1]+"%</td></tr>";
        str+= "<tr><td>煤</td>      <td>"+data1[2]+"</td>                                   <td>"+data2[2]+"%</td></tr>";
        str+= "<tr><td>油</td>      <td>"+data1[3]+"</td>                                   <td>"+data2[3]+"%</td></tr>";
        str+= "<tr><td>蒸汽</td>    <td>"+data1[4]+"</td>                                    <td>"+data2[4]+"%</td></tr>";
        str+= "<tr><td>天然气</td>   <td>"+data1[5]+"</td>                                   <td>"+data2[5]+"%</td></tr>";
        str+= "<tr><td>冷量</td>     <td>"+data1[6]+"</td>                                   <td>"+data2[6]+"%</td></tr>";
        str+= "<tr><td>能源总量</td> <td>"+data1[7]+"</td><td>"+data1[11]+"</td>              <td>"+data2[7]+"%</td></tr>";
        str+= "<tr><td>资源总量</td> <td>"+data1[8]+"</td><td>"+data1[12]+"</td>              <td>"+data2[8]+"%</td></tr>";
    $("#SourceTable").append(str);
}