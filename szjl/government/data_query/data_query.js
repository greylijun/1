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

//导出报表和在线打印切换
$('#export_report').click(function () {
    $(".menu_bar li a").removeClass('active');
    $(this).addClass('active');
});
$('#online_print').click(function () {
    $(".menu_bar li a").removeClass('active');
    $(this).addClass('active');
});
