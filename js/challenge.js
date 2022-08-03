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
  let ins = document.getElementsByClassName("add_chal_input");
  let cat = ins[4].value;
  // console.log(cat);

  let container = document.getElementById(cat);
  // console.log(container);
  let txt = '<button class="challenge_btn">\
            <table class="challenge_widget">\
                <tbody class="widget_body">\
                    <tr class="name_div"><td class="name">'+ins[0].value+'</td></tr>\
                    <tr class="points_div"><td class="points">'+ins[2].value+' | '+ins[3].value+'</td></tr>\
                    <tr class="author_div"><td class="author">'+ins[1].value+'</td></tr>\
                </tbody>\
            </table>\
        </button>\
        <div class="popup">\
            <table class="popup_content">\
                <tr class="popup_header_tr"><td class="popup_header">'+ins[0].value+'<span class="close">&times;</span></td></tr>\
                <tr class="popup_desc_tr"><td class="popup_desc">'+ins[5].value+'</td></tr>\
                <tr class="popup_input_tr"><td class="popup_input">\
                <form action="challenge.php">\
                Input Flag: <input class="flag_input" id="flag_input_test" type="text" placeholder="RVCTF{flag}">\
                </form>\
                </td></tr>\
            </table>\
        </div>'
  console.log(txt);
  container.innerHTML = container.innerHTML + txt;

  // reset all buttons and popups
  chal_popups = document.getElementsByClassName("popup");
  chal_btns = document.getElementsByClassName("challenge_btn");

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

  for (let i of ins){
    ins.value = '';
  }

  add_chal_box.style.display = "none";
}