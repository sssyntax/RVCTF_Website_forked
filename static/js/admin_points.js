const pointsToAdd = document.getElementById('points_to_add');
const searchBar = document.getElementById('search');
async function addPoints(element){
    const points = pointsToAdd.value;
    const username = element.parentElement.parentElement.querySelector('.username').textContent;
    const team = element.parentElement.parentElement.querySelector('.team_name').textContent;
    const userid = element.dataset.userid;
    if (points == null || points == "0" || points == "") return;
    var confirmResult = confirm(`Are you sure you want to add ${points} points to ${username} from ${team}?`);
    if (!confirmResult) return;
    var result = await postRequest("backend/add_points.php", {userid: userid, points: points})
    if (result.success){
        alert("Points Added Successfully")
        element.parentElement.parentElement.querySelector('.total_points').textContent = result.points
    }
    else{
        alert(result.error)
    }
}

function search(){
    var searchValue = this.value;
    var rows = document.querySelectorAll('.user');
    for (let row of rows){
        if (row.querySelector('.username').textContent.toLowerCase().includes(searchValue.toLowerCase())){
            row.style.display = "table-row";
        }
        else{
            row.style.display = "none";
        }
    }
}

searchBar.addEventListener('input', search)