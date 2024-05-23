async function submitForm(event){
    event.preventDefault()
    const form = document.querySelector('form')
    const formData = new FormData(form)
    const response = await postRequest('backend/teamcreation.php',formData)
    if(response.success){
        alert("Team has been created.")
        window.location.href = "index.php?filename=team"
    }
    else alert(response.error)
    return false
    
}