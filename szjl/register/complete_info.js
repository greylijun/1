$(document).ready(function(){
    $.getJSON("../utils/industry_select.php",{
        'industry_type':$("#industry_type").val()
    },function(json){
        for(var i=0;i<json.length;i++){
            var data = json[i];
            $("#second_industry_type").append("<option>"+data.second_industry+"</option>");
        }
    });
    $("#industry_type").change(function(){
        $.getJSON("../utils/industry_select.php",{
            'industry_type':$("#industry_type").val()
        },function(json){
            $("#second_industry_type").empty();
            for(var i=0;i<json.length;i++){
                var data = json[i];
                $("#second_industry_type").append("<option>"+data.second_industry+"</option>");
            }
        });
    });
    $.getJSON("display_register.php",function(json){
        $("#enter_name").val(json.enter_name);
        $("#legal_person").val(json.legal_person);
        $("#registered_address").val(json.registered_address);
        $("#production_address").val(json.production_address);
        $("#license_registration_number").val(json.lic_reg_num);
        $("#organization_code").val(json.organization_code);
        $("#business_phone").val(json.business_contacts);
        $("#E_mail").val(json.E_mail);
        $("#zip_code").val(json.zip_code);
        $("#fax").val(json.fax);
        $("#business_contacts").val(json.business_contacts);
        $("#contact_number").val(json.contact_number);
    });
    $("#button2").click(function(){
        if(!isItemNull("enter_name","单位名称") && !isItemNull("legal_person","单位法人") && !isItemNull("registered_address","单位注册地址") && !isItemNull("production_address","单位生产地址") && !isItemNull("license_registration_number","营业执照注册号") && !isItemNull("organization_code","组织机构代码") && !isItemNull("business_phone","单位电话") && !isItemNull("E_mail","E-mail") && !isItemNull("zip_code","邮政编码") && !isItemNull("business_contacts","单位联系人") && !isItemNull("contact_number","联系人号码")){
            $.post("complete_info.php", {
                    enter_name:$("#enter_name").val(),
                    legal_person:$("#legal_person").val(),
                    registered_address:$("#registered_address").val(),
                    production_address:$("#production_address").val(),
                    license_registration_number:$("#license_registration_number").val(),
                    organization_code:$("#organization_code").val(),
                    business_phone:$("#business_phone").val(),
                    E_mail:$("#E_mail").val(),
                    zip_code:$("#zip_code").val(),
                    fax:$("#fax").val(),
                    business_contacts:$("#business_contacts").val(),
                    contact_number:$("#contact_number").val()
                },function(json){
                    console.log(111);
                    console.log(json);
                }
            );
            location.href = "complete.php";
        }
    });
    $("#button1").click(function(){
        location.href = "detail.php";
    });
    $("#button3").click(function(){
        location.href = "index.php";
    });

    $("#button4").click(function(){
        if(!isItemNull('file','单位照片') && !isItemNull('file2','营业执照图片') && !isItemNull('about_enter','单位简介')){
            $("#submit").ajaxSubmit(function(data){
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
                    //sweetAlert("上传成功！");
                    $("#submit2").ajaxSubmit(function(data){
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
                            //sweetAlert("上传成功！");
                            $.post("update_information.php",{
                                'region':$("#region").val(),
                                'industry_type':$("#industry_type").val(),
                                'second_industry_type':$("#second_industry_type").val(),
                                'unit_industry_type':$("#unit_industry_type").val(),
                                'about_enter':$("#about_enter").val()
                            },function(json){
                                if(json == '8006'){
                                    swal({
                                        title:"注册成功,请等待管理员审核，审核通过后会收到邮件提醒!"
                                    },function(){
                                        location.href = "../index.php";
                                    })
                                }else{
                                    sweetAlert("注册失败，请联系管理员！");
                                }
                            });
                        }
                        else if(data=="PathInsertError"){
                            sweetAlert("图片路径获取失败，请联系管理员！");
                            return false;
                        }
                    });
                }
                else if(data=="PathInsertError"){
                    sweetAlert("图片路径获取失败，请联系管理员！");
                    return false;
                }
            });
        }
    });
});

function isItemNull(key,value){
    if($('#' + key).val() == ""){
        sweetAlert(value + "不能为空！");
        return true;
    }else{
        return false;
    }
}


























