"use strict";

var chal_popups = document.getElementsByClassName("popup");
var chal_btns = document.getElementsByClassName("challenge_btn");
var span = document.getElementsByClassName("close");

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