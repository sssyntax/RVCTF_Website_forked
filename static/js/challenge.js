"use strict";
// Session variables
var admin = document.getElementsByTagName("BODY")[0].dataset.admin
// Document elements for popup
var chal_popup = document.getElementById("popup");
var title_popup = document.getElementById("title_popup");
var desc_popup = document.getElementById("desc_popup");
var id_popup = document.getElementsByClassName("challengeID");
var cat_popup = document.getElementById("challengeCat");
var input_popup_uncompleted = document.getElementById('popup_input_uncompleted') // input td for user to input flag
var input_popup_completed = document.getElementById('popup_input_completed') // td to indicate user has completed challenge
// Document elements for challenge
var chal_btns = document.getElementsByClassName("challenge_btn");
var closespan = document.getElementById("close");
var add_chal_box = document.getElementById("add_chal_box");
var add_chal_close = document.getElementById('add_chal_close');
// Get rdev footer element to make sure new categories are inserted before it
var rdev_footer = document.getElementById('rdev-footer');

if (add_chal_close != null) {
  add_chal_close.onclick = function(){
    add_chal_box.style.display = 'none';
  }
}

// Close the challenge popup
closespan.onclick = popupClose;

// Set event listener for all challenge buttons
for (let i=0; i<chal_btns.length; i++) {
  chal_btns[i].onclick = popup;

}

function popupClose() {
  // Hide the popup elements
  chal_popup.style.display = "none";
  input_popup_uncompleted.style.display = 'none';
  input_popup_completed.style.display = 'none';
  // reset the value of the flag input
  input_popup_uncompleted.value = '';
}

function popup() {
  // check if the challenge is completed
  if (this.dataset.completed == 1) {
    // show the td indicating completion 
    input_popup_completed.style.display = 'block';
  }
  else {
    // show the input td
    input_popup_uncompleted.style.display = 'block';
  }
  // Display challenge popup
  chal_popup.style.display = "block";
  // Set challenge title and description
  desc_popup.innerText = this.dataset.desc
  title_popup.innerText = this.dataset.title
  // only admins will see this form feature (for deletion)
  if (admin == 1) {
    cat_popup.value = this.dataset.cat
  }
  // pass ID value into form for submission
  for (let item of id_popup) {
    item.value = this.dataset.id
  }
}

function addChal(){
  add_chal_box.style.display = "block";
}



function submitAnswer(form,event){
  event.preventDefault()
  var formdata = new FormData(form)
  console.log(formdata)
  try {
    fetch("backend/submitchallenge.php", { method: "POST", body: formdata })
  .then(response => response.json()) // wait for the asynchronous fetch 
  .then(result => { // wait for the asynchronous json() method
    // reset all buttons and popups
    chal_popup.style.display = "none"
    input_popup_uncompleted.style.display = 'none'; // reset the input td
    input_popup_uncompleted.children[0].children[1].value = ""; // reset the flag input's value to ""
    input_popup_completed.style.display = 'none'; // reset the completion td
    // Alert user that they got the answer correct
    alert(result) 
    // answer is correct
    if (result == "Correct answer") {
      // disable challenge for user
      // Search for correct button to disable
      for (let i=0; i<chal_btns.length; i++) {
        // Check if the button's title is the same as the popup's title
        if (chal_btns[i].dataset.title == title_popup.textContent) {
          // indicate under data that challenge is compeleted
          chal_btns[i].dataset.completed = 1;
          // For the css to register the change
          chal_btns[i].children[0].dataset.completed = 1;
          }
      }
    }
      
  })
  }
  catch (error) {
    alert(error)
  }
  return false  
  
}

function submitChallenge(form,event){
  // Handle output when new challenge is created
  event.preventDefault()
  var formdata = new FormData(form)
  fetch("backend/addchallenge.php", { method: "POST", body: formdata })
  .then(response => response.json()) // wait for the asynchronous fetch
  .then(result => {
    alert(result[0])
    if (result[0] == "Success"){
      // RDev ppl can do the add in new challenges here!
    // Array of all inputs
    let ins = document.getElementsByClassName("add_chal_input");
    let cat = document.getElementById("add_chal_cat").value;
    let container = document.getElementById(cat);
    let difficultylst = ["Easy","Medium","Hard"]
    // Check if the category does not exist
    if (container == null) {
      // Create a new container
      let title = document.createElement('h1');
      title.textContent = cat;
      title.classList.add('topic_header')
      // create a new container
      container = document.createElement('div');
      container.id = cat;
      // add the new elements into the DOM
      document.body.insertBefore(title, rdev_footer);
      document.body.insertBefore(container, rdev_footer);
    }
    // Create new button element
    let btn = document.createElement("button");
    // Set metadata for button
    btn.dataset.desc = ins[5].value;
    btn.dataset.title = ins[0].value;
    btn.dataset.completed = 0;
    btn.dataset.id = result[1];
    btn.classList.add("challenge_btn");
    btn.onclick = popup;

    // create the table containing all the challenge
    let table = document.createElement("table");
    table.classList.add("challenge_widget");
    let tbody = document.createElement("tbody"); 
    tbody.classList.add("widget_body");

    // Create name data row
    let nameRow = document.createElement("tr");
    nameRow.classList.add("name_div");
    let nameData = document.createElement("td");
    nameData.classList.add("name");
    nameData.textContent = ins[0].value;
    nameRow.appendChild(nameData);

    // Create points data row
    let pointsRow = document.createElement("tr");
    pointsRow.classList.add("points_div");
    let pointsData = document.createElement("td");
    pointsData.classList.add("points");
    pointsData.textContent = `${ins[2].value} | ${difficultylst[ins[3].value]}`
    pointsRow.appendChild(pointsData);

    // Create author data row
    let authorRow = document.createElement("tr");
    authorRow.classList.add("author_div");
    let authorData = document.createElement("td");
    authorData.classList.add("author");
    authorData.textContent = ins[0].value
    authorRow.appendChild(authorData);

    // Append the 3 rows to the table
    tbody.appendChild(nameRow);
    tbody.appendChild(pointsRow);
    tbody.appendChild(authorRow);
    table.appendChild(tbody);
    btn.appendChild(table);
    container.appendChild(btn);
    // reset all buttons and popups
    chal_popup.style.display = "none";
    for (let item of ins){
      item.value = '';
    }
    add_chal_box.style.display = "none";
      }
  })
  return false
}

function deleteChallenge(form, event) {
  // Handle output when new challenge is created
  event.preventDefault();
  var formdata = new FormData(form);
  fetch("backend/deletechallenge.php", { method: "POST", body: formdata })
  .then((response) => response.json())
  .then((result) => {
    // Close the popup
    popupClose();
    alert(result);
    // Get the category of the challenge to delete
    let category = document.getElementById(formdata.get('cat'));
    // Check if the number of challenges in the category is 1
    if (category.children.length == 1) {
      // Remove the category from the DOM
      category.parentElement.removeChild(category.previousElementSibling);
      document.body.removeChild(category)
    }
    // Iterate through all the challenges in the category  
    for (let challege of category.children) {
      if (challege.dataset.cat == formdata.get('cat')) {
        if (challege.dataset.id == formdata.get('id')) {
          category.removeChild(challege);
        }
      }
    }
  });
}