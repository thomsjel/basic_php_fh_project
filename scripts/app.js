document.querySelector(".log").style.display = "none";
document.querySelector(".register").style.display = "none";
document.querySelector(".loader").style.display = "block";

setTimeout(()=>{
  document.querySelector(".loader").style.display = "none";
  document.querySelector(".log").style.display = "block";
  document.querySelector(".register").style.display = "block";
}, 300);

function viewHidePW(identifier) {
var viewPW = document.getElementById("inputPW" + identifier);
var text = document.getElementById("viewHide" + identifier);

  if (viewPW.type === "password") {
    viewPW.type = "text";
    text.innerHTML = "Hide password";
  } else {
    viewPW.type = "password";
    text.innerHTML = "View password";
  }
}

//wird bei einem onclick ausgelöst
function droppy() {
  var drop = document.getElementById("myDropdown");

  document.getElementById("myDropdown").classList.toggle("show");

// wenn man irgendwo hinklickt: show remove
  drop.click = function (event) {
    if (!event.target.matches('.profile')) {
      let dropdowns = document.getElementsByClassName("dropdown-content");
      let i;
      for (i = 0; i < dropdowns.length; i++) {
        let openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
}

//wird bei einem onclick ausgelöst
function poppy() {
  document.getElementById("popUp").classList.add("showPopup");
}

function poppyClose() {
  document.getElementById("popUp").classList.remove("showPopup");
}

$(document).ready();


function pressed(id){
  var friendy = document.getElementById(id);
  var frID = friendy.value;
  var frIDint = parseInt(frID);
  console.log("Übergabeparamenter: " + id + " | " + "Value: " + frID);
  if(id === frID){
  // friendy.classList.toggle('active');
    return id;
  }
}