<div class="popup" id="popup">
    <table class="popup_content">
        <tr class="popup_header_tr">
            <td class="popup_header">
                <span id="title_popup">

                </span>
                <span class="close" id="close">&times;</span>
                <?php if ($isAdmin) { ?>
                    <form onsubmit="deleteChallenge(this, event)" style='display: inline;'>
                        <input type="hidden" name="id" class='challengeID'>
                        <button class="delete" type="submit"><img src="static/images/trash.png" alt="Delete"
                                style='width:1.5rem;'></button>
                    </form>
                <?php }
                ; ?>
                <br>
                <span style="font-size:0.8em;font-weight:normal;">Solved By <span id="solved_count"></span></span>
                <br>
                <!-- Added first blood here -->
                <span style="font-size:0.8em;font-weight:normal;">First Blood: <span id="firstblood_popup"></span></span>
            </td>
        </tr>
        <tr class="popup_desc_tr">
            <td class="popup_desc">
                <div id="desc_popup" style='overflow: scroll;height: 20ch;display:block;'>

                </div>
                <div id="file_names" style='display: none;'>
                    <h3>Additional Materials</h3>
                    <ul id="file_names_list">
                    </ul>
                </div>
                <div>
                    Author: <span id="author_popup"></span>
                </div>
            </td>
        </tr>
        <tr class="popup_input_tr">
            <td class="popup_input" id="popup_input_uncompleted" style='display: none;'>
                <form onsubmit="submitAnswer(this,event)">
                    <input type="hidden" name="id" class='challengeID'>
                    Input Flag: <input class="flag_input" id="flag_input_test" type="text" name="answer"
                        placeholder="RVCTF{flag}">
                </form>
            </td>
            <td class="popup_input" id="popup_input_completed" style='display: none;'>
                Completed
            </td>
        </tr>
    </table>
</div>