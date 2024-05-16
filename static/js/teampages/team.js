
var disbandButton = document.querySelector('.disband');
async function disband(){
    var confirmation = confirm("Are you sure you want to disband this team?");
    if(confirmation){
        const response = await postRequest('backend/disband.php',{})
        if(response == "Success"){
            alert("Team has been disbanded.")
            window.location.href = "index.php?filename=teamcreation"
        }
        else alert(response)
    }
} 

disbandButton.addEventListener('click',disband)