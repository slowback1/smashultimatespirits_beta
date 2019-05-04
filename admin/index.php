<?php include 'templates/adminHeader.php'; ?>

<script>   
    let addSpirit = `
        <div class="adminBody">
            <h1>Add Spirit</h1>
            <label for="id">ID:<input type="number" placeholder="ID" id="spiritID" required /></label>
            <label for="name">Name:<input type="text" placeholder="name" id="spiritName" required /></label>
            <label for="game">Game:<input type="text" placeholder="game" id="spiritGame" required /></label>
            <label for="series">Series:<select id="spiritSeries">
                <option value="">Series</option>
                <option value="Smash">Super Smash Brothers</option>
                <option value="Mario">Super Mario</option>
                <option value="DK">Donkey Kong</option>
                <option value="Zelda">The Legend of Zelda</option>
                <option value="Metroid">Metroid</option>
                <option value="Yoshi">Yoshi</option>
                <option value="Kirby">Kirby</option>
                <option value="StarFox">Star Fox</option>
                <option value="Pokemon">Pokemon</option>
                <option value="FZero">F-Zero</option>
                <option value="Mother">Earthbound/Mother</option>
                <option value="IceClimber">Ice Climber</option>
                <option value="FireEmblem">Fire Emblem</option>
                <option value="GameWatch">Game &amp; Watch</option>
                <option value="AnimalCrossing">Animal Crossing</option>
                <option value="KidIcarus">Kid Icarus</option>
                <option value="Pikmin">Pikmin</option>
                <option value="Wario">Wario</option>
                <option value="ROB">R.O.B.</option>
                <option value="WiiFit">Wii Fit</option>
                <option value="PunchOut">Punch-Out!!</option>
                <option value="Xenoblade">Xenoblade</option>
                <option value="DuckHunt">Duck Hunt</option>
                <option value="Splatoon">Splatoon</option>
                <option value="MetalGear">Metal Gear</option>
                <option value="Sonic">Sonic The Hedgehog</option>
                <option value="MegaMan">Mega Man</option>
                <option value="PacMan">Pac-Man</option>
                <option value="StreetFighter">Street Fighter</option>
                <option value="FinalFantasy">Final Fantasy</option>
                <option value="Bayonetta">Bayonetta</option>
                <option value="Castlevania">Castlevania</option>
                <option value="Mii">Mii</option>
                <option value="Persona">Persona</option>
                <option value="Other">Other</option>
            </select></label>
            <label for="description">Description:</input type="text" placeholder="description" id="spiritDescription" required /></label>
            <button onClick="handleAddSpirit()">Add Spirit </button>
            <script src="scripts/handleAddSpirit.js"></script>
        </div>
    `;
    let editSpirit = `
        <div class='adminBody'>
            <select id='allSpirits'>

            </select>
            <script='scripts/loadSpirits.js'></script>
            <script>loadSpirits(['allSpirits']);
            <label for="name">Name:<input type="text" placeholder="name" id="spiritName"  /></label>
            <label for="game">Game:<input type="text" placeholder="game" id="spiritGame"  /></label>
            <label for="series">Series:<select id="spiritSeries">
                <option value="">Series</option>
                <option value="Smash">Super Smash Brothers</option>
                <option value="Mario">Super Mario</option>
                <option value="DK">Donkey Kong</option>
                <option value="Zelda">The Legend of Zelda</option>
                <option value="Metroid">Metroid</option>
                <option value="Yoshi">Yoshi</option>
                <option value="Kirby">Kirby</option>
                <option value="StarFox">Star Fox</option>
                <option value="Pokemon">Pokemon</option>
                <option value="FZero">F-Zero</option>
                <option value="Mother">Earthbound/Mother</option>
                <option value="IceClimber">Ice Climber</option>
                <option value="FireEmblem">Fire Emblem</option>
                <option value="GameWatch">Game &amp; Watch</option>
                <option value="AnimalCrossing">Animal Crossing</option>
                <option value="KidIcarus">Kid Icarus</option>
                <option value="Pikmin">Pikmin</option>
                <option value="Wario">Wario</option>
                <option value="ROB">R.O.B.</option>
                <option value="WiiFit">Wii Fit</option>
                <option value="PunchOut">Punch-Out!!</option>
                <option value="Xenoblade">Xenoblade</option>
                <option value="DuckHunt">Duck Hunt</option>
                <option value="Splatoon">Splatoon</option>
                <option value="MetalGear">Metal Gear</option>
                <option value="Sonic">Sonic The Hedgehog</option>
                <option value="MegaMan">Mega Man</option>
                <option value="PacMan">Pac-Man</option>
                <option value="StreetFighter">Street Fighter</option>
                <option value="FinalFantasy">Final Fantasy</option>
                <option value="Bayonetta">Bayonetta</option>
                <option value="Castlevania">Castlevania</option>
                <option value="Mii">Mii</option>
                <option value="Persona">Persona</option>
                <option value="Other">Other</option>
            </select></label>
            <label for="description">Description:</input type="text" placeholder="description" id="spiritDescription" /></label>
            <button onClick="handleEditSpirit()">Edit Spirit </button>
            <script src="scripts/handleEditSpirit.js"> </script>
        </div>
    `;
    let deleteSpirit = `
        <div class="adminBody">
            <select id="allSpirits">

            </select>
            <script src="scripts/loadSpirits.js"></script>
            <script>loadSpirits(['allSpirits']);</script>
            <button onClick="handleDeleteSpirit()">Delete Spirit</div>
            <script src="scripts/handleDeleteSpirit.js"></script>
        </div>
    `;
    let addQuestion = `
        <div class="adminBody">
            <label for="question">Question:<input type="text" id="question" placeholder="Question" required /></label>
            <label for="corAns">Correct Answer:<select id="corAns">

            </select></label>
            <label for="wrongAnswers">Wrong Answers:<select id="wrongAns1">
                <option value="0">Random</option>
            </select>
            <select id="wrongAns2">
                <option value="0">Random</option>
            </select>
            <select id="wrongAns3">
                <option value="0">Random</option>
            </select>
            <button onClick="handleAddQuestion()>Add Question</button>
            <script src="scripts/handleAddQuestion.js></script>
            <script src="loadSpirits"></script>
            <script>loadSpirits(['corAns', 'wrongAns1', 'wrongAns2', 'wrongAns3']);</script>
            
        </div> 
    `;
    let editQuestion = `
        <div class="adminBody">
            <label for="allQuestions">Original Question to Edit:<select id="allQuestions">

            </select></label>
            <script src="scripts/loadQuestions.js"></script>
            <script>loadQuestions('allQuestions');</script>
            <label for="question">Question:<input type="text" placeholder="Question" id="question" /></label>
            <label for="corAns">Correct Answer:<select id="corAns">

            </select></label>
            <label for="wrong answers">Wrong Answers:<select id="wrongAns1">
                <option value="0">Random</option>
            </select>
            <select id="wrongAns2">
                <option value="0">Random</option>
            </select>
            <select id="wrongAns3">
                <option value="0">Random</option>
            </select>
            <button onClick="handleEditQuestion()">Edit Question</button>
            <script src="loadSpirits"></script>
            <script>loadSpirits(['corAns', 'wrongAns1', 'wrongAns2', 'wrongAns3']);</script>
            <script src="scripts/handleEditQuestion.js"></script>
        </div>
    `;
    let deleteQuestion = `
        <div class="adminBody">
            <label for="allQuestions">Question to Delete:<select id="allQuestions">

            </select></label>
            <script src="scripts/loadQuestions.js"></script>
            <script>loadQuestions(['allQuestions']);</script>
            <button onClick="handleDeleteQuestion()">Delete Question</button>
            <script src="scripts/handleDeleteQuestion.js"></script>
        </div>
    `;
    let changePassword = `
        <div class="adminBody">
            <h1>Change Password</h1>
            <label for="oldPassword">Old Password:<input type="password" id="oldPassword" /></label>
            <label for="newPassword1"> New Password: <input type="password" id="newPassword1" /></label>
            <label for="newPassword2">Retype New Password: <input type="password" id="newPassword2" /></label>
            <button onClick="handleChangePassword()">Change Password</button>
            <script src="scripts/handleChangePassword.js"></script>
        </div>
    `;
    let home = `
        <div class="adminBody">
            <div class="adminSection">
                <h2>Spirits</h2>
                <button onClick="changeState('addSpirit')">Add</button>
                <button onClick="changeState('editSpirit')">Edit</button>
                <button onClick="changeState('deleteSpirit')">Delete</button>
            </div>
            <div class="adminSection">
                <h2>Questions</h2>
                <button onClick="changeState('addQuestion')">Add</button>
                <button onClick="changeState('editQuestion')">Edit</button>
                <button onClick="changeState('deleteQuestion')">Delete</button>
            </div>
            <div class="adminSection">
                <h2>Other Actions</h2>
                <button onClick="changeState('changePassword')">Change Password</button>
                <button><a href="../actions/logout.php">Log Out</a></button>
            </div>
        </div>
    `;

    function changeState(givenState) {
        switch(givenState) {
            case 'addSpirit':
                let state = "addSpirit";
                responsehtmlcode = addSpirit;
                break;
            case 'editSpirit':
                let state = "editSpirit";
                responsehtmlcode = editSpirit;
                break;
            case 'deleteSpirit':
                let state = "deleteSpirit";
                responsehtmlcode = deleteSpirit;
                break;
            case 'addQuestion':
                let state = "addQuestion";
                responsehtmlcode = addQuestion;
                break;
            case 'editQuestion':
                let state = "editQuestion";
                responsehtmlcode = editQuestion;
                break;
            case 'deleteQuestion':
                let state = "deleteQuestion";
                responsehtmlcode = deletequestion;
                break;
            case 'changePassword':
                let state = "changePassword";
                responsehtmlcode = changePassword;
                break;
            default:
                let state = "home";
                responsehtmlcode = home;
                break;
        }
        history.pushState({}, null, `index.php?state=${state}`);
        document.getElementById('main').innerHTML = responsehtmlcode;
    }
    var parts = window.location.search.substr(1).split("&");
        var $_GET = {};
        for (var i = 0; i < parts.length; i++) {
            var temp = parts[i].split("=");
            $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
        }
    window.onload(changeState($_GET.state));
</script>


<?php include 'templates/adminFooter.php'; ?>