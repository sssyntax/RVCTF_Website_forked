
const disbandButton = document.querySelector('.disband');
const kickButtons = document.querySelectorAll('.kick');
const leaveButton = document.querySelector('.leave');
console.log(kickButtons)
async function disband(){
    var confirmation = confirm("Are you sure you want to disband this team?");
    if(confirmation){
        const response = await postRequest('backend/disband.php',{})
        if(response.success){
            alert("Team has been disbanded.")
            window.location.href = "index.php?filename=teamcreation"
        }
        else alert(response.error)
    }
} 

async function kickUser(){
    var user = this.dataset.user
    var userId = this.dataset.userid
    var confirmation = confirm(`Are you sure you want to kick ${user}?`);
    if (!confirmation) return false;
    const response = await postRequest('backend/kickUser.php',{"userid": userId})
    if(response.success){
        alert("User has been kicked.")
        window.location.href = "index.php?filename=team"
    }
    else alert(response.error)
}

async function leaveTeam(){
    var confirmation = confirm("Are you sure you want to leave this team?");
    if(confirmation){
        const response = await postRequest('backend/leaveTeam.php',{})
        if(response.success){
            alert("You have left the team.")
            window.location.href = "index.php?filename=teamcreation"
        }
        else alert(response.error)
    }
}
if (disbandButton) disbandButton.addEventListener('click',disband)
if (kickButtons) kickButtons.forEach(button => button.addEventListener('click',kickUser))
if (leaveButton) leaveButton.addEventListener('click',leaveTeam)