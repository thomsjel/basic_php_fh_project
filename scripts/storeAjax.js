$(document).ready(function(){

    $(".delGame").click(function(){
        //console.log("geht");

        var me = $(this);
        var request = $.ajax({
            url:"ajax.php",
            method:"POST",
            data:{gameID: $(this).data("id")}
        });
        request.done(function(antwort){
            //console.log(antwort);
            if(antwort === "gameDeleted"){
                //console.log(me));
                me.parent().remove(); //parent is das button element
            }
        });
    });

    $(".gameUpload").click(function(){
        //console.log("geht");

        var me = $(this);
        var request = $.ajax({
            url:"ajax.php",
            method:"POST",
            data:{gameUp: $(this).data("id")}
        });
        request.done(function(antwort){
            var text = document.getElementById("uploadFeedback");
            if (antwort === "errror") {
                text.innerHTML = "Upload error";
            }
            if (antwort === "hochgeladen") {
                text.innerHTML = "Upload successful";
                location.reload();
            }
        });
    });

    $(".downloadGame").click(function(){
        var me = $(this);
        var request = $.ajax({
            url:"ajax.php",
            method:"POST",
            data:{gameDown: $(this).data("id")}
        });
        request.done();
    });

});