/**
 * Created by LiJun on 2015/11/11.
 */
$(document).ready(function(){
    $("#submit").click(function(){
        $.getJSON("judge_data.php",{
            'data_year':$("#data_year").val(),
            'data_month':$("#data_month").val()
        },function(json){
            if(json == '8006'){
                $("#submit0").ajaxSubmit(function(data){
                    //console.log(data);
                    if(data=="UploadError"){
                        sweetAlert("文件上传失败，请重新上传！");
                        return false;
                    }else if(data=="FileSizeError"){
                        sweetAlert("文件大小不能超过4M，请重新上传！");
                        return false;
                    }
                    else if(data=="FileTypeError"){
                        sweetAlert("文件格式错误");
                        return false;
                    }
                    else if(data=="UpLoadSuccess"){
                        sweetAlert("上传成功！");
                    }
                    else if(data=="PathInsertError") {
                        sweetAlert("图片路径获取失败，请联系管理员！");
                        return false;
                    }
                });
                $("#file0").val("");
            }
        });
        save_energy_consumption();                  //提交能耗数据
        $("input[name='data']").val("");            //清空文本框内容
    });
    $("#method_submit").click(function(){
        energy_saving_method();                     //提交节能措施
        $("#submit2").ajaxSubmit(function(data){
            //console.log(data);
            if(data=="UploadError"){
                sweetAlert("文件上传失败，请重新上传！");
                return false;
            }else if(data=="FileSizeError"){
                sweetAlert("文件大小不能超过4M，请重新上传！");
                return false;
            }
            else if(data=="FileTypeError"){
                sweetAlert("文件格式错误");
                return false;
            }
            else if(data=="UpLoadSuccess"){
                sweetAlert("上传成功！");
            }
            else if(data=="PathInsertError"){
                sweetAlert("图片路径获取失败，请联系管理员！");
                return false;
            }
            $("#file1").val("");
        });
        $("input[name='this_year']").val("");       //清空文本框内容

    });
    $("#finish_submit").click(function(){
        energy_saving_finish();                     //提交节能措施完成情况
        $("#submit3").ajaxSubmit(function(data){
            //console.log(data);
            if(data=="UploadError"){
                sweetAlert("文件上传失败，请重新上传！");
                return false;
            }else if(data=="FileSizeError"){
                sweetAlert("文件大小不能超过4M，请重新上传！");
                return false;
            }
            else if(data=="FileTypeError"){
                sweetAlert("文件格式错误");
                return false;
            }
            else if(data=="UpLoadSuccess"){
                sweetAlert("上传成功！");
            }
            else if(data=="PathInsertError"){
                sweetAlert("图片路径获取失败，请联系管理员！");
                return false;
            }
            $("#file2").val("");
        });
        $("input[name='finish_year']").val("");       //清空文本框内容
        $("select[name='finish_year']").val("");
    });
    $.getJSON("energy_saving_select.php",function(json){
        select_name(json);                          //选择项目名称
    });
    //根据项目名称调出往年节能措施，并修改提交完成情况
    $("#pro_name").change(function(){
        $.getJSON("energy_saving_show.php",{
            'pro_name':$("#pro_name").val()
        },function(json){
            if($("#pro_name").val() == ""){
                document.getElementById("start_time_finish").value="";
                document.getElementById("end_time_finish").value="";
                document.getElementById("finish_investment").value="";
                document.getElementById("finish_payback").value="";
                document.getElementById("finish_saving_money").value="";
                document.getElementById("download").href="";
                document.getElementById("finish_material_volume").value="";
            }else{
                document.getElementById("start_time_finish").value=""+json.start_time+"";
                document.getElementById("end_time_finish").value=""+json.end_time+"";
                document.getElementById("finish_investment").value=""+json.investment+"";
                document.getElementById("finish_payback").value=""+json.payback+"";
                document.getElementById("finish_saving_money").value=""+json.money+"";
                $("#download").click(function(){
                    if(json.address == null){
                        sweetAlert("当前项目不存在节能措施内容附件！");
                    }else{
                        window.open(""+json.address+"");
                    }
                });
                document.getElementById("finish_material_volume").value=""+json.material+"";
            }
        });
    });
    $('#consumption_entry').click(function () {
        $(".area li").removeClass('active');
        $(this).addClass('active');
        $("#de1").show();
        $("#de2").hide();
    });
    $('#energy_saving_entry').click(function () {
        $(".area li").removeClass('active');
        $(this).addClass('active');
        $("#de1").hide();
        $("#de2").show();
    });
});

//能耗数据录入
function save_energy_consumption(){
        $.post("insert_energy_consumption.php",{
            'data_year':$("#data_year").val(),
            'data_month':$("#data_month").val(),
            'coal1':$("#coal1").val(),
            'coal2':$("#coal2").val(),
            'coal3':$("#coal3").val(),
            'coal4':$("#coal4").val(),
            'coal5':$("#coal5").val(),
            'oil1':$("#oil1").val(),
            'oil2':$("#oil2").val(),
            'oil3':$("#oil3").val(),
            'oil4':$("#oil4").val(),
            'oil5':$("#oil5").val(),
            'oil6':$("#oil6").val(),
            'oil7':$("#oil7").val(),
            'cold_quantity':$("#cold_quantity").val(),
            'steam':$("#steam").val(),
            'water1':$("#water1").val(),
            'water2':$("#water2").val(),
            'water3':$("#water3").val(),
            'gas1':$("#gas1").val(),
            'gas2':$("#gas2").val(),
            'gas3':$("#gas3").val(),
            'gas4':$("#gas4").val(),
            'gas5':$("#gas5").val(),
            'gas6':$("#gas6").val(),
            'gas7':$("#gas7").val(),
            'gas8':$("#gas8").val(),
            'gas9':$("#gas9").val(),
            'gas10':$("#gas10").val(),
            'gas11':$("#gas11").val(),
            'gas12':$("#gas12").val(),
            'gas13':$("#gas13").val(),
            'electricity':$("#electricity").val()
        },function(json){
            if(json == "8007"){
                sweetAlert("当前日期存在未审核数据，请等待管理员审核后再次提交！");
            }else{
                if(json == ""){
                    sweetAlert("能耗数据插入失败！")
                }else{
                    sweetAlert("能耗数据插入成功！");
                }
            }
        });
}

//节能措施录入
function energy_saving_method(){
    if(!isItemNull("project_name","项目名称") && !isItemNull("start_time","开始时间") && !isItemNull("end_time","结束时间") && !isItemNull("investment","投资额") && !isItemNull("payback","回收期") && !isItemNull("saving_money","节约量金额") && !isItemNull("material_volume","实物量")){
        $.post("energy_saving_insert.php",{
            'project_name':$("#project_name").val(),
            'start_time':$("#start_time").val(),
            'end_time':$("#end_time").val(),
            'investment':$("#investment").val(),
            'payback':$("#payback").val(),
            'saving_money':$("#saving_money").val(),
            'material_volume':$("#material_volume").val()
        },function(json){
            if(json == "节能措施录入成功！"){
                sweetAlert("节能措施录入成功！");
            }else{
                sweetAlert("节能措施录入失败！");
            }
        });
    }
}

//判断是否有相同的项目名称
function query_name(){
    $.post("query_name.php",{
        'project_name':$("#project_name").val()
    },function(json){
       if(json == "8006"){
           sweetAlert("当前项目名称已经存在，请重新输入！");
       }
    });
}


//项目名称选择
function select_name(json){
        $("#pro_name").append("<option value=''></option>");
    for(var i=0;i<json.length;i++){
        var data = json[i];
        $("#pro_name").append("<option value='"+data+"'>"+data+"</option>");
    }
}

//节能措施完成情况录入
function energy_saving_finish(){
    if(!isItemNull("pro_name","项目名称")){
        $.post("energy_saving_finish_insert.php",{
            'pro_name':$("#pro_name").val(),
            'start_time_finish':$("#start_time_finish").val(),
            'end_time_finish':$("#end_time_finish").val(),
            'finish_investment':$("#finish_investment").val(),
            'finish_payback':$("#finish_payback").val(),
            'finish_saving_money':$("#finish_saving_money").val(),
            'finish_material_volume':$("#finish_material_volume").val()
        },function(json){
            if(json != ""){
                sweetAlert("节能措施录入成功！");
            }else{
                sweetAlert("节能措施录入失败！");
            }
        });
    }else{
    }
}
function isItemNull(key,value) {
    if ("" == $('#' + key ).val() || null == $('#'+key).val()) {
        sweetAlert(value + "不能为空！");
        return true;
    } else {
        return false;
    }
}