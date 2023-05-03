<!DOCTYPE html>
<head>
<title>RVCTF Team Invite</title>
    <link rel="stylesheet" href="static/css/team_join_popup.css">
    <link rel="icon" type="image/x-icon" href="../../static/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Saira+Stencil+One&family=Saira+Stencil+One&display=swap" rel="stylesheet">
</head>
<body>
    <h1>You have been invited to teamname</h1>
    <div id = "Content">
        <div id="team_leader">Team leader: team leader name</div>
        <div class="dropdown">
            <div class="dropbtn" onclick = "show()">Team members</div>
            <div id="dropdown-content">
                <div id="dd_content">Name 1</div>
                <div id="dd_content">Name 2</div>
                <div id="dd_content">Name 3</div>
            </div>
        </div>
            <button name = "action" type="submit" value="Accept">Accept</button>
            <button name = "action" type="submit" value="Decline">Decline</button>
    </div>
</body>
<script>
    var FirstTime = true
    function show(){
        if (FirstTime == true){
            document.getElementById("dropdown-content").style.display = "block";
            FirstTime = false
        }
        else{
            if (document.getElementById("dropdown-content").style.display == "none"){
            document.getElementById("dropdown-content").style.display = "block";
        }
        else{
            document.getElementById("dropdown-content").style.display = "none";
        }
        }
        
    }
</script>