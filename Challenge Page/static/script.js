"use strict";

var chal_popups = document.getElementsByClassName("popup");
var chal_btns = document.getElementsByClassName("challenge_btn");
var span = document.getElementsByClassName("close");
var add_chal_box = document.getElementById("add_chal_box");
var add_chal_close = document.getElementById('add_chal_close')

add_chal_close.onclick = function(){
  add_chal_box.style.display = 'none';
}

for (let i=0; i<chal_popups.length; i++) {
  chal_btns[i].onclick = function() {
    chal_popups[i].style.display = "block";
  }
  span[i].onclick = function() {
    chal_popups[i].style.display = "none";
  }
  window.addEventListener("click", function(event) {
    if (event.target == chal_popups[i]) {
      chal_popups[i].style.display = "none";
    }
  });
}

function addChal(){
  add_chal_box.style.display = "block";
}

function submitChal(){
  // RDev ppl can do the add in new challenges here!
  add_chal_box.style.display = "none";
}