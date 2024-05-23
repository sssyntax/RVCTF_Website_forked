<title>Challenges</title>
<link rel="stylesheet" href="static/css/createChallenge.css">
</head>

<body>
    <form onsubmit="submitChallenge(this,event)">
        <div id="add_chal_box">
            <table class="add_chal_content">
                <tr class="add_chal_tr" id="add_chal_title_tr">
                    <td class="add_chal_td">Title:</td>
                    <td class="add_chal_td_input"><input name="title" class="add_chal_input button" id="add_chal_title"
                            type="text" placeholder="What is it called?"></td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_author_tr">
                    <td class="add_chal_td">Author:</td>
                    <td class="add_chal_td_input"><input name="author" class="add_chal_input button" id="add_chal_author"
                            type="text" placeholder="Who did this?"></td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_points_tr">
                    <td class="add_chal_td">Points:</td>
                    <td class="add_chal_td_input"><input name="points" class="add_chal_input button" id="add_chal_points"
                            type="number" min="0" placeholder="How many points to be awarded?"></td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_difficulty_tr">
                    <td class="add_chal_td">Difficulty:</td>
                    <td class="add_chal_td_input">
                        <select class="add_chal_input button"  id="add_chal_difficulty" name="difficulty">
                            <option value="0">Easy</option>
                            <option value="1">Medium</option>
                            <option value="2">Hard</option>
                        </select>
                    </td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_cat_tr">
                    <td class="add_chal_td">Category:</td>
                    <td class="add_chal_td_input">
                        <select class="add_chal_input button" id="add_chal_cat" name="category">
                            <option value="Forensics">Forensics</option>
                            <option value="Crypto">Cryptography</option>
                            <option value="Web">Web Exploit</option>
                            <option value="Reverse Engineering">Reverse Engineering</option>
                            <option value="PWN">PWN</option>
                            <option value="OSINT">OSINT</option>
                        </select>
                    </td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_desc_tr">
                    <td class="add_chal_td">Description:</td>
                    <td class="add_chal_td_input">
                        <textarea name="desc" class="add_chal_input button" id="add_chal_desc" type="text"
                            placeholder="Description to be shown to members" cols="30" rows="10"></textarea>
                    </td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_link_tr">
                    <td class="add_chal_td">Solution:</td>
                    <td class="add_chal_td_input"><input name="solution" class="add_chal_input button" id="add_chal_link"
                            type="text" placeholder="Solution"></td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_link_tr">
                    <td class="add_chal_td">Additional Files:</td>
                    <td class="add_chal_td_input">
                        <div class = "button add_chal_input">
                            <input name="files[]" class="file_upload" id="add_chal_link"
                                type="file" placeholder="Additional Files" multiple>
                            <div class = "file_names">

                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_link_tr">
                    <td class="add_chal_td" colspan="2">
                            <input type="submit" class = "button" id="add_chal_submit_btn" value="Submit">
                    </td>
                </tr>
            </table>

        </div>
    </form>
    <script src = "static/js/createChallenge.js"></script>
</body>

</html>