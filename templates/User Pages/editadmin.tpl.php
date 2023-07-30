    <title>Edit Admin</title>
    <link rel="stylesheet" href="static/css/makeadmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'templates/Components/stars.php';?>
    <div id = "content">
        <div id = 'header'>
            <h1>Edit Admin</h1>
        </div>
        <div>
            <form action='backend/editadmin.php'method='post'>
                <!-- <label for='email'>Email:</label> -->
                <input type=text id='email' name='email' placeholder='Email' >
                <input type='submit' id='submit' value='Search'>
            </form>
            <form id='confirm'></form> 

            <?php 
                if (isset($_GET['error'])){
                    if ($_GET['error'] == '"nullerror"'){
                        echo '<p style="text-align: center;">Please key in the email.</p>';
                    }
                    else if ($_GET['error'] == '"invalidemail"'){
                        echo '<p style="text-align: center;">Please key in a valid email address.</p>';
                    }
                    else if ($_GET['error'] == '"nosuchuser"'){
                        echo '<p style="text-align: center;">There is no such user, try again.</p>';
                    }
                    else if ($_GET['error'] == '"databaseerror"'){
                        echo '<p style="text-align: center;">Database error.</p>';
                    }
                }
                if (isset($_GET['success'])){
                    if ($_GET['success'] == '"removed"'){
                        echo '<p style="text-align: center;"> Success, user is no longer an admin.</p>';
                    }
                    if ($_GET['success'] == '"added"'){
                        echo '<p style="text-align: center;"> Success, user is now an admin.</p>';
                    }
                }


            ?>

            <script>
            async function postRequest(destination,data,action){
                let formObject = data instanceof FormData ? data : new FormData()
                data = data ?? {} 
                for (const [key,value] of Object.entries(data)){
                    formObject.append(key,value)
                }
                
            //     try{
            //         result = await response.json()
            //     }
            //     catch (e){
            //         return ""
            //     }
                
            //     return action ? action(result) : result  
            // }
                try {
                    const response = await fetch(destination, { method: "POST", body: formObject });
                    console.log("res");
                    console.log(response)
                    const result = await response.json();
                    console.log('res2')
                    return action ? action(result) : result;
                } 
                catch (error) {
                    // console.log("Error while fetching or parsing response:", error);
                    return null; // Or return an error object or handle the error in another way
                }
            }


            function confirmform(response) {
                if (response.confirm){
                    // Display the confirmation message to the user
                    const label = document.createElement('label');
                    label.setAttribute("for", "submit");
                    label.innerHTML = response.message;
                    // Create the confirm button
                    const confirmButton = document.createElement('input');
                    confirmButton.setAttribute("id", "submit")
                    confirmButton.setAttribute("type", "submit");
                    confirmButton.setAttribute("value", "Confirm");
                    confirmButton. addEventListener("submit", (e)=>{
                        e.preventdefault();
                    });
                    // Append the confirm button to the container
                    const container = document.getElementById('confirm');
                    container.appendChild(label);
                    container.appendChild(confirmButton);
                }
            }

            // Function to send the initial request for confirmation
            async function sendConfirmation() {
                // Send the request to the backend using AJAX
                let response = await postRequest('backend/editadmin.php');
                console.log('response send conf')
                console.log(response)
                // Handle the response from the backend
                //confirmform(response);
            }

            // Call the function to initiate the confirmation process
            sendConfirmation();
            </script>
        </div>
    </div>
</body>