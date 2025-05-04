<?php
function createChallengeButton($value, $difficultylst, $inTeam = false) {
    $desc = htmlspecialchars($value["description"]);
    $title = htmlspecialchars($value["title"]);
    $id = htmlspecialchars($value["id"]);
    $cat = htmlspecialchars($value["category"]);
   // $teamCompleted = $inTeam ? htmlspecialchars($value["teamsolved"]) : htmlspecialchars($value["individualsolved"]);
    $teamCompleted = htmlspecialchars($value["teamsolved"]);
    $individualCompleted = htmlspecialchars($value["individualsolved"]);
    $author = htmlspecialchars($value["author"]);
    $points = htmlspecialchars($value["points"]);
    $difficulty = htmlspecialchars($difficultylst[$value["difficulty"]]);
    $solved_by = htmlspecialchars($value["solve_count"]);
    $file_names = $value["file_names"];

    // NEW: Proper completed logic (team or individual)
    $completed = ($value["teamsolved"] || $value["individualsolved"]) ? 1 : 0;

    return <<<HTML
<button class="challenge_btn" 
        data-desc="$desc" 
        data-title="$title" 
        data-id="$id" 
        data-cat="$cat" 
        data-completed="$completed" 
        data-author="$author"
        data-teamcompleted="$teamCompleted"
        data-individualcompleted="$individualCompleted"
        data-filenames='$file_names'>
    <table class="challenge_widget">
        <tbody class="widget_body">
            <tr class="name_div">
                <td class="name">$title</td>
            </tr>
            <tr class="points_div">
                <td class="points">$points points | $difficulty</td>
            </tr>
            <tr class="solved_by_div">
                <td class="solved_by">Solved By $solved_by</td>
            </tr>
        </tbody>
    </table>
</button>
HTML;
}
?>
