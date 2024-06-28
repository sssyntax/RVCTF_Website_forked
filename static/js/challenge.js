"use strict";
// Session variables
var admin = document.getElementsByTagName("BODY")[0].dataset.admin
// Document elements for popup
var chal_popup = document.getElementById("popup");
var title_popup = document.getElementById("title_popup");
var desc_popup = document.getElementById("desc_popup");
const author_popup = document.getElementById("author_popup");
var id_popup = document.getElementsByClassName("challengeID");
var cat_popup = document.getElementById("challengeCat");
var input_popup_uncompleted = document.getElementById('popup_input_uncompleted') // input td for user to input flag
var input_popup_completed = document.getElementById('popup_input_completed') // td to indicate user has completed challenge
// Document elements for challenge
var chal_btns = document.getElementsByClassName("challenge_btn");
var closespan = document.getElementById("close");
var add_chal_box = document.getElementById("add_chal_box");
var add_chal_close = document.getElementById('add_chal_close');
// Get points to update it after each challenge is completed
var points_span = document.getElementById('points');
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
function addFile($fileName){
  var fileList = document.getElementById('file_names');
  const fileDownload = document.createElement('a');
  fileDownload.href = `challengeMaterials/${$fileName}`;
  fileDownload.download = $fileName;
  fileDownload.innerText = $fileName;
  console.log(fileDownload)
  fileList.appendChild(fileDownload);
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
  // Set challenge title and description and author
  desc_popup.innerHTML = this.dataset.desc
  title_popup.innerText = this.dataset.title
  author_popup.innerText = this.dataset.author
  // Set Additional Material Downloads
  const fileNames = JSON.parse(this.dataset.filenames);
  const fileList = document.getElementById('file_names');
  if (fileNames.length > 0) fileList.style.display = 'flex';
  else fileList.style.display = 'none';

  fileList.innerHTML = '';
  for (let fileName of fileNames) {
    addFile(fileName);
  }
  // set the count of users who have solved the challenge
  document.getElementById('solved_count').innerText = "..."
  getSolvedCount(this.dataset.id).then((count) => {
    document.getElementById('solved_count').innerText = count
  })
  // pass ID value into form for submission
  for (let item of id_popup) {
    item.value = this.dataset.id
  }
}

function addChal(){
  add_chal_box.style.display = "block";
}



async function submitAnswer(form,event){
  event.preventDefault()
  var formdata = new FormData(form)
  console.log(formdata)
  var response = await postRequest("backend/submitchallenge.php",formdata)
  if (response.success){
    alert("Correct Flag!")
    // Close the popup
    popupClose();
    // Update the points
    points_span.innerText = response.points
    const currentChallenge = document.querySelector(`[data-id="${formdata.get('id')}"]`)
    currentChallenge.dataset.individualcompleted = 1
    currentChallenge.dataset.teamcompleted = 1
  }
  else{
    alert(response.error)
  }

  return false  
  
}



async function deleteChallenge(form, event) {
  const confirmation = confirm("Are you sure you want to delete this challenge?");
  event.preventDefault();
  if (!confirmation) {
    return false;
  }
  // Handle output when new challenge is created
  var formdata = new FormData(form);
  var response = await postRequest("backend/deletechallenge.php", formdata);
  if (response.error) {
    alert(response.error);
    return false;
  }
  else{
    popupClose();
    alert(response.success);
    let item = document.querySelector(`[data-id="${formdata.get('id')}"]`);
    if (item.parentElement.children.length == 0) {
      item.parentElement.parentElement.parentElement.removeChild(item.parentElement.parentElement);
    }
    item.parentElement.removeChild(item);
    return true;
  }
  
}

async function getSolvedCount(challengeID){
  let response = await getRequest("backend/getSolvedCount.php",{challengeID:challengeID})
  if (response.error){
    alert(response.error)
  }
  return response.data
}
