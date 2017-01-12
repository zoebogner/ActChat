var time = 0;

/*
var updateTime = function (cb) {
  $.getJSON("time", function (data) {
      cb(data);
  });
};
*/

var sendChat = function (message, cb) {
    var msg = encodeURIComponent(message);
    $.getJSON("chat/insert_chat?message=" + msg, function (data){
        cb();
    });
};

var addDataToReceived = function (arrayOfData) {
  arrayOfData.forEach(function (data) {
    //$("#received").val($("#received").val() + "\n" + data[0]);

    $('#received').append("<p>"+data[0]+"</p>");


    });
};

var getNewChats = function () {
    //console.log("fetching chats..");
    $.getJSON("chat/get_chats?time=" + time, function(data){
        addDataToReceived(data);
        // reset scroll height
        setTimeout(function(){

        }, 0);

        if(data.length > 0)
        {
            time = data[data.length-1][1];
        } else {

        }
    });



};



// using JQUERY's ready method to know when all dom elements are rendered
$( document ).ready ( function () {


    var h = $(window).height();
    $('#received').height(h);

    //var c = 0;

  // set an on click on the button
  $("form").submit(function (evt) {
    evt.preventDefault();
    var data = $("#text").val();
    $("#text").val('');
    // get the time if clicked via a ajax get query
    sendChat(data, function (){
      //alert("done");
    });




  });

  //var out = $("#received");

  setInterval(function (){
    getNewChats(0);
    var org_height = $('#received').height();
        //console.log($('#received').scrollTop());
        //console.log($('#received')[0].scrollHeight);
        //console.log($('#received').scrollTop());
        console.log($('#received').scrollTop() + org_height);
        //console.log(org_height);
        console.log($('#received')[0].scrollHeight);

        if( $('#received').scrollTop() + org_height + 100 >= $('#received')[0].scrollHeight) {
                $('#received').scrollTop($('#received')[0].scrollHeight);
            }


    //console.log("fetch chats");
  },1200);
});
