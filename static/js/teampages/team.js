
var disbandButton = document.querySelector('.disband');
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

disbandButton.addEventListener('click',disband)