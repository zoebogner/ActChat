var BASE_URL = '/ActChat/';

$(document).ready(function() {
    $('.mode_change').click(function(){
        var btn = $(this);
        //we the ID of the button that was clicked on
        var id_of_item = $(this).attr("id");
        $.ajax({
            url: BASE_URL+"admin/change_mode", //This is the page where you will handle your SQL insert
            type: "POST",
            data: "id=" + id_of_item, //The data your sending to some-page.php
            success: function(){
                //console.log("AJAX request was successfull");
                $('.mode_change').removeClass("btn-primary");
                $(btn).addClass("btn-primary");

            },
            error:function(){
                //console.log("AJAX request was a failure");
            }
        });
    });

    $('#clear_chat').click(function(){
        $.ajax({
            url: BASE_URL+"admin/clear_chat", //This is the page where you will handle your SQL insert
            type: "POST",
            data: "id=1", //The data your sending to some-page.php
            success: function(){
                //console.log("AJAX request was successfull");
            },
            error:function(){
                //console.log("AJAX request was a failure");
            }
        });
    });


    // var msg = $("#text").val();
    // console.log(msg);

    //$(document).on("click", ".inputarea", function() {

    var input = $("#polltext");

    $('#startpoll').on("click", function(){
        msg = $('#polltext').val();

        $.ajax({
            url: BASE_URL+"poll/start", //This is the page where you will handle your SQL insert
            type: "POST",
            data: "message="+msg, //The data your sending to some-page.php
            success: function(){
                //console.log("AJAX request was successfull");
                // $('form.inputarea').append('<button type="submit" id="stoppoll" class="btn btn-lg btn-default btn-block">Stop poll</button>');
                $('button#stoppoll').fadeIn('1');
                $('button#startpoll').fadeOut('2');

            },
            error:function(){
                console.log("AJAX request 'startpoll' was a failure");
            }
        });
    });

    $('#stoppoll').on("click", function(){
        //e.preventDefault();
        $.ajax({
            url: BASE_URL+"poll/stop", //This is the page where you will handle your SQL insert
            type: "POST",
            data: "id=1", //The data your sending to some-page.php
            success: function(){
                //console.log("AJAX request was successfull");
                // $('form.inputarea').append('<button type="submit" value="startpoll" id="startpoll" class="btn btn-lg btn-default btn-block">Start poll</button>');
                $('button#startpoll').fadeIn('1');
                $('button#stoppoll').fadeOut('1');

            },
            error:function(){
                console.log("AJAX request 'stoppoll' was a failure");
            }
        });
    });

    //});

    // $('#text').summernote({
    //     height: 100,
    //     toolbar: [
    //     //[groupname, [button list]]
    //
    //         ['style', ['bold', 'italic', 'underline', 'clear']],
    //         ['font', ['strikethrough']],
    //         ['fontsize', ['fontsize']],
    //         ['color', ['color']],
    //         ['para', ['ul', 'ol', 'paragraph']]
    //     ]
    // });


});
