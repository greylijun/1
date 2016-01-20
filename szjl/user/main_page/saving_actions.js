/**
 * Created by LiJun on 2015/12/17.
 */
$(document).ready(function(){
    $("#query_saving").click(function(){
        $.getJSON("saving_actions_user.php",{
            'year':$("#year_select").val(),
            'state':$("#state").val()
        },function(json){
            showtable(json);
        });
    });
});

function showtable(json){
    $("#saving_table").empty();
    var divnum=1;
    for(var i=0;i<json.length;i++){
        var data = json[i];
        var td = "<tr><td>"+divnum+"<td>"+data.submit_year+"</td><td id='pro_name"+divnum+"'>"+data.name+"</td><td>"+data.start_time+"</td><td>"+data.end_time+"</td><td>"+data.investment_volume+"</td><td>"+data.save_money+"</td><td>"+data.material_volume+"</td><td>"+data.payback_period+"</td><td>"+data.if_finish+"</td><td><a onclick='downloadfile("+divnum+")'>下载附件</a></td></tr>";
        $("#saving_table").append(td);
        divnum++;
    }
}

function downloadfile(divnum){
    var pro_name1 = document.getElementById("pro_name"+divnum).innerText;
    $.getJSON("download_file.php",{
        'project_name':pro_name1,
        'state':$("#state").val()
    },function(json){
        if(json.download_address == ""){
            sweetAlert("当前节能措施不存在相关附件！");
        }else{
            window.open(""+json.download_address+"");
        }
    })
}