
var store = document.getElementById("store");
var play = document.getElementById("play");
var friends = document.getElementById("friends");
var currentuser = document.getElementById("currentuser");

function display(i){

    if(i === 1) {
        store.style.display = "block";
        play.style.display = "none";
        friends.style.display = "none";
        currentuser.style.display = "none";
    }else if(i === 2) {
        play.style.display = "block";
        store.style.display = "none";
        friends.style.display = "none";
        currentuser.style.display = "none";
    }else if(i === 3) {
        friends.style.display = "block";
        store.style.display = "none";
        play.style.display = "none";
        currentuser.style.display = "none";
    }else if(i === 4) {
        currentuser.style.display = "block";
        store.style.display = "none";
        friends.style.display = "none";
        play.style.display = "none";
    }else{
        store.style.display = "block";
        play.style.display = "none";
        friends.style.display = "none";
        currentuser.style.display = "none";
    }

}