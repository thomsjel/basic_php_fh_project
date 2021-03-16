$(document).ready(function(){

    $(".delAccount").click(function(){

        if(confirm('Are you sure you want to delete this account?') == true){
            var request = $.ajax({
                url:"ajax.php",
                method:"POST",
                data:{delAcc: $(this).data("id")}
            });
            request.done();
            window.location.href = "./index.php";
        }
    });

    $(".chooseChar").click(function(){
        var request = $.ajax({
            url:"ajax.php",
            method:"POST",
            data:{characterID: $(this).data("id")}
        });
        request.done(function(answer){
            if(answer === "avatarSaved"){
                location.reload();
            }
        });
    });
});