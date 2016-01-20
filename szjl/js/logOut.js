/**
 * Created by LiJun on 2016/1/15.
 */
//三级页面
function logOut() {
    swal({
        title: "是否退出系统？",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是",
        cancelButtonText: "否",
        closeOnConfirm: false
    }, function () {
        $.post('../../../utils/logout.php', function () {
            swal({
                title: "退出成功！",
                text: "点击确定按钮返回首页！"
            }, function () {
                location.href = '../../../index.php';
            });
        });
    });
}

//二级页面
function logOut1() {
    swal({
        title: "是否退出系统？",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "是",
        cancelButtonText: "否",
        closeOnConfirm: false
    }, function () {
        $.post('../../utils/logout.php', function () {
            swal({
                title: "退出成功！",
                text: "点击确定按钮返回首页！"
            }, function () {
                location.href = '../../index.php';
            });
        });
    });
}