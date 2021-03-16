$(document).ready(function(){

    $(".delete").click(function(){
        //console.log("geht");

        var me = $(this);
        var request = $.ajax({
            url:"ajax.php",
            method:"POST",
            data:{id_th: $(this).val()}
        });
        request.done(function(antwort){
            //console.log(antwort);
            if(antwort === "done"){
                //console.log(me));
                me.parent().remove(); //parent is das button element
            }
        });
    });

    var searchFriend = document.getElementById('searchFriend');
    var text = document.getElementById("foundedFriend");

    function deletePops(time){
        setTimeout(function(){text.innerHTML = "";} , time);
    }

    $(".searchButton").click(function(){
        var request = $.ajax({
            url:"ajax.php",
            method:"POST",
            data:{friend: $("#searchFriend").val()}
        });
        request.done(function (answer){
            var text =  document.getElementById("foundedFriend");
            text.style.color = "#FFFFFF";
            if(answer === "found"){
                text.innerHTML = $("#searchFriend").val() + " " + "<button class='friendRequest styledButton'>&#x271A;</button>";
            }
            if(answer === "error"){
                text.innerHTML = "User not found";
                text.style.color = "#FF416C";
                deletePops(2000);
            }
            if(answer === "foundsame"){
                text.innerHTML = "This is you";
                text.style.color = "#FF416C";
                deletePops(2000);
            }
            if(answer === "foundfriended"){
                text.innerHTML = "Already your friend";
                text.style.color = "#FF416C";
                deletePops(2000);
            }
            if(answer === "foundreqq"){
                text.innerHTML = "There is already a request to this user.";
                text.style.color = "#FF416C";
                deletePops(3000);
            }
            if(answer === "foundadmin" || answer === "erroradmin"){
                text.innerHTML = "Admin can not be your friend.";
                text.style.color = "#FF416C";
                deletePops(2000);
            }

            searchFriend.value = "";

            $(".friendRequest").click(function() {
                var request = $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    data: "anfrage"
                });
                request.done(function (answer) {
                    if (answer === "req") {
                        text.innerHTML = "Friend request was sent!";
                        text.style.color = "#06d6a0";
                        //window.style.cursor = "default";
                        deletePops(3000);
                    }
                });
            });
        });
    });

    $('.accept').click(function(){
        var me = $(this);
        var idBtn = $(this).data("id");
        console.log(idBtn);

        var request = $.ajax({
            url:"ajax.php",
            method:"POST",
            data:{id_req: idBtn}
        });
        request.done(function(answer){
            if (answer === "accept") {
                me.parent().remove();
                location.reload();
            }
        });
    });

    $('.deny').click(function(){
        var me = $(this);
        var idBtn = $(this).data("id");
        console.log(idBtn);

        var request = $.ajax({
            url:"ajax.php",
            method:"POST",
            data:{id_den: idBtn}
        });
        request.done(function(answer){
            if (answer === "deny") {
                me.parent().remove();
                location.reload();
            }
        });
    });

    $('.delFriend').click(function(){
        var me = $(this);
        var idBtn = $(this).data("id");
        var request = $.ajax({
            url:"ajax.php",
            method:"POST",
            data:{id_delFriend: idBtn}
        });
        request.done(function(answer){
            if (answer === "deleted") {
                me.parent().remove();
                //location.reload();
            }
        });
    });

    $('.writeFr').click(function(){
        var me = $(this);
        var idBtn = $(this).data("id");
        var request = $.ajax({
            url:"ajax.php",
            method:"POST",
            data:{id_write: idBtn}
        });
        request.done(function(answer){
            if (answer === "show") {
                //me.parent().remove();
                location.reload();
            }
        });
    });

    var msges = document.getElementById("messages");
    msges.scrollTop = msges.scrollHeight;
    var msgText = document.getElementById("msgText");

    function sendMessage(){
        var request = $.ajax({
            url:"ajax.php",
            method:"POST",
            data:{text: $(".msgText").val()}
        });
        msges.scrollTop = msges.scrollHeight;
        request.done(function(answer){

            if (answer === "chatted") {
                //location.reload();
                $("#messages").load("./friends.php #msgDiv");
                msges.scrollTop = msges.scrollHeight;
                msgText.value = "";
            }
        });
    }
//senden mit klick auf button
    $(".sendMsg").click(function(){
        sendMessage();
    });

    setInterval(function(){
        $("#messages").load(window.location.href + " #msgDiv" );
        msges.scrollTop = msges.scrollHeight;
    }, 1000);
});