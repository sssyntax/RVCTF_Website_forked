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
        <div id='forms'>
            <form id = 'editadminform'>
                <!-- <label for='email'>Email:</label> -->
                <input type=text id='email' name='email' placeholder='Email' >
                <input type='submit' id='submit' class = 'submit' value='Search'>
            </form>
            <p id='test'></p>
            <div id='response'></div>

            <script>
            
            const form = document.querySelector('#editadminform');
            form.addEventListener('submit', event => {
                event.preventDefault();
                document.querySelector("#response").innerHTML = '';
                sendemail();
            });

            var res = ''
            const confirm = document.createElement('FORM');
            confirm.setAttribute('id', 'confirmform');

            var admin = 0;
            var emailvar = '';
            var id = 0;

            //send the editadminform details to editadmin.php
            async function sendemail(){
                const formdata = new FormData(form);
                const data = new URLSearchParams(formdata);
                const email = await fetch('backend/editadmin.php', {
                    method: 'POST',
                    body: data,
                })
                res = await email.json();

                //if no email
                if (res.message == 'nullerror'){
                    var p = document.createElement('p');
                    p.innerHTML = 'Please key in the email.';
                    document.querySelector("#response").appendChild(p);

                //if email is not an email
                } else if (res.message == 'invalidemail'){
                    var p = document.createElement('p');
                    p.innerHTML = 'Please key in a valid email.';
                    document.querySelector("#response").appendChild(p);

                //if cannot find email in database
                } else if (res.message == 'nosuchuser'){
                    var p = document.createElement('p');
                    p.innerHTML = 'There is no such user.';
                    document.querySelector("#response").appendChild(p);
                
                //add confirm form 
                } else if (res.confirm == true) {
                    admin = res.admin;
                    id = res.id;
                    emailvar = data.get('email');
                    confirm.innerHTML = '';
                    var button = document.createElement('input');
                    button.setAttribute('type', 'submit');
                    button.setAttribute('id', 'confirm');
                    button.setAttribute('value', 'Confirm');
                    button.setAttribute('class', 'submit');
                    var label = document.createElement('label');
                    label.innerHTML = res.message;
                    label.setAttribute('for', 'confirm');
                    confirm.addEventListener('submit', event => {
                        event.preventDefault();
                        document.querySelector("#response").innerHTML = '';
                        sendconfirm();
                    });
                    document.querySelector('#forms').appendChild(confirm);
                    confirm.appendChild(label);
                    confirm.appendChild(button);
                };
            };

            //send confirmform data to editadmin2.php
            async function sendconfirm(){
                document.querySelector("#confirmform").innerHTML = '';
                const data = new URLSearchParams();
                data.append('confirm', true);
                data.append('admin', admin);
                data.append('email', emailvar);
                data.append('id', id)
                const check = await fetch('backend/editadmin2.php', {
                    method: 'POST',
                    body: data,
                });
                outcome = await check.json();

                //if success
                if (outcome.success == true){
                    document.querySelector('#response').innerHTML = '';
                    var success = document.createElement('p');
                    success.innerHTML = outcome.message;
                    success.style.textAlign = 'center';
                    document.querySelector("#response").appendChild(success);
                }
                //if fail
                else{
                    document.querySelector('#response').innerHTML = '';
                    var fail = document.createElement('p');
                    fail.innerHTML = "Something went wrong, try again.";
                    fail.style.textAlign = 'center';
                    document.querySelector("#response").appendChild(fail);
                }
            };
           
            </script>
        </div>
    </div>
</body>