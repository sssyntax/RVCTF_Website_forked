async function submitChallenge(form,event){
    // Handle output when new challenge is created
    event.preventDefault()
    var formdata = new FormData(form)
    const response = await postRequest("backend/addchallenge.php",formdata)
    console.log(response)
    if (response.success){
        form.reset()
        var fileNameDiv = document.querySelector(".file_names")
        fileNameDiv.innerHTML = ""
        alert("Challenge Created Successfully")
    }
    else{
        alert(response.error)
    }

    return false
  }

  function addFileName(event){
    var fileNameDiv = document.querySelector(".file_names")
    fileNameDiv.innerHTML = ""
    for (const file of event.target.files){
        var newFileName = document.createElement("div")
        newFileName.classList.add("file_name")
        newFileName.innerText = file.name
        fileNameDiv.appendChild(newFileName)
    }
  }

  const fileInput = document.querySelector(".file_upload")
fileInput.addEventListener("change",addFileName)