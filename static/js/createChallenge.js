async function submitChallenge(form,event){
    // Handle output when new challenge is created
    event.preventDefault()
    var formdata = new FormData(form)
    const response = await postRequest("backend/addchallenge.php",formdata)
    console.log(response)
    if (response.success){
        form.reset()
        alert("Challenge Created Successfully")
    }
    else{
        alert(response.error)
    }

    return false
  }