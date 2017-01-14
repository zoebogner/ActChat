var time = 0;
var BASE_URL = '/chat/';


var updateTime = function (cb) {
  $.getJSON("time", function (data) {
      cb(data);
  });
};

var sendChat = function (message, cb) {
    var msg = encodeURIComponent(message);
    $.getJSON(BASE_URL + "chat/insert_chat?message=" + msg, function (data){
        cb();
    });
};

var addDataToReceived = function (arrayOfData) {
  arrayOfData.forEach(function (data) {
    //$("#received").val($("#received").val() + "\n" + data[0]);
    $("#received").append("<p>"+data[0]+"</p>");
  });
};

var getNewChats = function () {
    //console.log("fetching chats..");

    $.getJSON(BASE_URL + "chat/get_chats?time=" + time, function(data){
        addDataToReceived(data);
        // reset scroll height
        setTimeout(function(){
           $('#received').scrollTop($('#received')[0].scrollHeight);
        }, 0);
        // what does this line do..?
        //console.log(data);
        //console.log(data.length);
        // ok, data is an object full of message and timestamp values
        // data.length appears to be the number of posts made since the last refresh
        //time = data[data.length-1][1];
        //console.log(time);
        // time is the timestamp of the last posted message!

        if(data.length > 0)
        {
            time = data[data.length-1][1];

        } else {

        }
    }).done(function(){

    });
};


// var getMode = function() {
//     console.log("fetching mode..");
//     $.getJSON(BASE_URL + "chats/get_mode", function(data) {
//
//     });
// };


// using JQUERY's ready method to know when all dom elements are rendered
$( document ).ready ( function () {
  // set an on click on the button

    //getNewChats(0);

    $("form").submit(function (evt) {
        evt.preventDefault();

        var data = $("#text").val();
        $("#text").val('');
        //var data = $('textarea[name="userinput"]').html($('#text').code());


        // get the time if clicked via a ajax get query
        sendChat(data, function (){
          //alert("done");
        });
    });

    setInterval(function (){
        getNewChats(0);

        //console.log("fetch chats");
    },1200);

});
