/**
 * Created by LiJun on 2015/12/3.
 */
$(document).ready(function(){
   $.getJSON("information_check.php",function(json){
       $("#register").val(json[0].register);
       $("#pass_review").val(json[0].pass_review);
       $("#no_pass_review").val(json[0].no_pass_review);
       $("#no_review").val(json[0].no_review);
       $("#Limit_commit").val(json[1].Limit_commit);
       $("#Limit_no_commit").val(json[1].Limit_no_commit);
       $("#limit_no_pass").val(json[1].limit_no_pass);
       $("#limit_pass").val(json[1].limit_pass);
       $("#limit_no_review").val(json[1].limit_no_review);
       $("#question_num").val(json[2].question_num);
       $("#answer_num").val(json[2].answer_num);
       $("#answer_no_num").val(json[2].answer_no_num);
       $("#no_verification").val(json[3].no_verification);
       $("#no_pass_verification").val(json[3].no_pass_verification);
       $("#pass_verification").val(json[3].pass_verification);
   });
});