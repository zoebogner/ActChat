var BASE_URL="/chat/";$(document).ready(function(){$(".mode_change").click(function(){var t=$(this),a=$(this).attr("id");$.ajax({url:BASE_URL+"admin/change_mode",type:"POST",data:"id="+a,success:function(){$(".mode_change").removeClass("btn-primary"),$(t).addClass("btn-primary")},error:function(){}})}),$("#clear_chat").click(function(){$.ajax({url:BASE_URL+"admin/clear_chat",type:"POST",data:"id=1",success:function(){},error:function(){}})});var t=$("#polltext");$("#startpoll").on("click",function(){msg=$("#polltext").val(),$.ajax({url:BASE_URL+"poll/start",type:"POST",data:"message="+msg,success:function(){$("button#stoppoll").fadeIn("1"),$("button#startpoll").fadeOut("2")},error:function(){console.log("AJAX request 'startpoll' was a failure")}})}),$("#stoppoll").on("click",function(){$.ajax({url:BASE_URL+"poll/stop",type:"POST",data:"id=1",success:function(){$("button#startpoll").fadeIn("1"),$("button#stoppoll").fadeOut("1")},error:function(){console.log("AJAX request 'stoppoll' was a failure")}})})});