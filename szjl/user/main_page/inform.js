/**
 * Created by zhangliqin on 2015/11/24.
 */
$('#mp2_page_1').click(function () {
    $("#mp2_page1").show();
    $("#mp2_page2").hide();
    $("#mp2_page3").hide();
    $(".page a").removeClass('active');
    $(this).addClass('active');
    console.log("test1");
});

$('#mp2_page_2').click(function () {
    $("#mp2_page1").hide();
    $("#mp2_page2").show();
    $("#mp2_page3").hide();
    $(".page a").removeClass('active');
    $(this).addClass('active');
    console.log("test1");
});

$('#mp2_page_3').click(function () {
    $("#mp2_page1").hide();
    $("#mp2_page2").hide();
    $("#mp2_page3").show();
    $(".page a").removeClass('active');
    $(this).addClass('active');
    console.log("test1");
});