"use strict";

var chal_test = document.getElementById("popup_test");

var chal_btn = document.getElementById("chal_btn_test");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
chal_btn.onclick = function() {
    chal_test.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  chal_test.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == chal_test) {
    chal_test.style.display = "none";
  }
}