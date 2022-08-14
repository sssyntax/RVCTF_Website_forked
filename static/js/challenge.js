"use strict";

// Document elements for popup
var chal_popup = document.getElementById("popup");
var title_popup = document.getElementById("title_popup");
var desc_popup = document.getElementById("desc_popup");
var id_popup = document.getElementById("challengeID");
// Document elements for challenge
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

// Set event listener for all challenge buttons
for (let i=0; i<chal_btns.length; i++) {
  chal_btns[i].onclick = function() {
    // Display challenge popup
    chal_popup.style.display = "block";
    // Set challenge title and description
    desc_popup.innerText = this.dataset.desc
    title_popup.innerText = this.dataset.title
    // pass ID value into form for submission
    id_popup.value = this.dataset.id 
  }

}

function addChal(){
  add_chal_box.style.display = "block";
}


function submitAnswer(form,event){
  event.preventDefault()
  var formdata = new FormData(form)
  fetch("backend/submitchallenge.php", { method: "POST", body: formdata })
  .then(response => response.json())
  .then(result => {
    alert(result) 
    // answer is correct
    if (result == "Answer is correct, well done :)") {
      // disable challenge for user
      // Search for correct button to disable
      for (let i=0; i<chal_btns.length; i++) {
        // Check if the button's title is the sameas the popup's title
        if (chal_btns[i].dataset.title == title_popup) {
          // Challenge disable button
          chal_btns[i].disabled = true;
          }
      }
    }
  
  })
  return false  
  
}

function submitChallenge(form,event){
  // Handle output when new challenge is created
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