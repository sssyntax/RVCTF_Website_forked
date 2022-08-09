"use strict";

var chal_popup = document.getElementById("popup");
var title_popup = document.getElementById("title_popup");
var desc_popup = document.getElementById("desc_popup");
var chal_btns = document.getElementsByClassName("challenge_btn");
var closespan = document.getElementById("close");
var add_chal_box = document.getElementById("add_chal_box");
var add_chal_close = document.getElementById('add_chal_close')

add_chal_close.onclick = function(){
  add_chal_box.style.display = 'none';
}
closespan.onclick = function(){
  chal_popup.style.display = "none";
}
for (let i=0; i<chal_btns.length; i++) {
  chal_btns[i].onclick = function() {
    chal_popup.style.display = "block";
    desc_popup.innerText = this.dataset.desc
    title_popup.innerText = this.dataset.title
    console.log("Ran")
  }

}

function addChal(){
  add_chal_box.style.display = "block";
}


function submitAnswer(form,event){
  event.preventDefault()
  var formdata = new FormData(form)
  fetch("backend/setlive.php", { method: "POST", body: formdata })
  return false  
  
}

function submitChallenge(form,event){
  event.preventDefault()
  var formdata = new FormData(form)
  fetch("backend/addchallenge.php", { method: "POST", body: formdata })
  .then(response => response.json())
  .then(result => {
    alert(result)
    if (result == "Success"){
      // RDev ppl can do the add in new challenges here!
  let ins = document.getElementsByClassName("add_chal_input");
  console.log(document.getElementById("add_chal_cat"))
  let cat = document.getElementById("add_chal_cat").value;
  // console.log(cat);
  console.log(cat);
  let container = document.getElementById(cat);
  // console.log(container);
  difficultylst = ["Easy","Medium","Hard"]
  let txt = `<button class="challenge_btn" data-desc = ${ins[5].value} data-title = ${ins[0].value}>\
            <table class="challenge_widget">\
                <tbody class="widget_body">\
                    <tr class="name_div"><td class="name">${ins[0].value}</td></tr>\
                    <tr class="points_div"><td class="points">${ins[2].value} | ${difficultylst[ins[3].value]}</td></tr>\
                    <tr class="author_div"><td class="author">${ins[1].value}</td></tr>\
                </tbody>\
            </table>\
        </button>\
        `
  container.innerHTML = container.innerHTML + txt;

  // reset all buttons and popups
  chal_popup.style.display = "none"

  for (let i of ins){
    ins.value = '';
  }

  add_chal_box.style.display = "none";
    }
  })

  
  return false
}