<?php /*
    Objectives Here:
        Redesign.  Keep the same general Melee Trophy Aesthetic, but change some things around, such as:
            Move the character swap arrows to the same area as the image
            Various Responsiveness issues, but especially change font size at certain screen sizes
            [ADD MORE HERE]
        Improve the performance.  This primarily means dont load the entire sidebar at once
        Improve the navigation experience.  It takes too long to scroll through all 1300 spirits in the sidebar, what are some better ways to speed up this process?  Possibly add a searchbar?
        Add a Random Spirit button
*/ ?>
<?php
    include_once 'connection/connect.php';
    if ($_GET['id'] == 0) {
        $id = rand(0, 1320);
    } else {
        $id = $_GET['id'];
    }
    
    $sql = "SELECT * FROM spirits WHERE id='$id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $sid = $row['id'];
            $name = $row['name'];
            $game = $row['game'];
            $series = $row['series'];
            $description = $row['description'];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/details/index.css" />
    <title><?php echo $name; ?> | Details</title>
</head>
<?php
    echo "<script>let currentID=$id;</script>";
?>
<body>
    <nav>
        <div onClick="getSpirit('previous', currentID)" class="navArrow" id="previousSpirit"><-- Previous Spirit</div>
        <a id="indexLink" href="index.php?place=<?php echo $id; ?>" class="navLink"> Return to Index </a>
        <div onClick="getSpirit('random', 0)" class="navLink"> Random Spirit </a></div>
        <div onClick="getSpirit('next', currentID)" class="navArrow" id="nextSpirit">Next Spirit --></div>
    </nav>
    <div class="descBody" id="descBody">
        <div class="descSection">
            <div class="searchHead">
            <form id="searchSettings">
                <input type="radio" name="sort" value="id">ID 
                <input type="radio" name="sort" value="name">Name
                <input type="radio" name="sort" value="game">Game
                <input type="radio" name="sort" value="series">Series
                <br />
                <input type="radio" name="series" value="AnimalCrossing"> Animal Crossing
                <input type="radio" name="series" value="Bayonetta"> Bayonetta
                <input type="radio" name="series" value="Castlevania"> Castlevania
                <input type="radio" name="series" value="DK"> Donkey Kong
                <input type="radio" name="series" value="DuckHunt"> Duck Hunt
                <input type="radio" name="series" value="FinalFantasy"> Final Fantasy
                <input type="radio" name="series" value="FireEmblem"> Fire Emblem
                <input type="radio" name="series" value="FZero"> F-Zero
                <input type="radio" name="series" value="GameWatch"> Game & Watch
                <input type="radio" name="series" value="IceClimber"> Ice Climber
                <input type="radio" name="series" value="KidIcarus"> Kid Icarus
                <input type="radio" name="series" value="Kirby"> Kirby
                <input type="radio" name="series" value="Mario"> Mario
                <input type="radio" name="series" value="MegaMan"> Mega Man
                <input type="radio" name="series" value="MetalGear"> Metal Gear
                <input type="radio" name="series" value="Metroid"> Metroid
                <input type="radio" name="series" value="Mii"> Mii
                <input type="radio" name="series" value="Mother"> Mother
                <input type="radio" name="series" value="Other"> Other
                <input type="radio" name="series" value="PacMan"> Pac-Man
                <input type="radio" name="series" value="Persona"> Persona
                <input type="radio" name="series" value="Pikmin"> Pikmin
                <input type="radio" name="series" value="Pokemon"> Pokemon
                <input type="radio" name="series" value="PunchOut"> Punch Out
                <input type="radio" name="series" value="ROB"> R.O.B.
                <input type="radio" name="series" value="Smash"> Super Smash Brothers
                <input type="radio" name="series" value="Sonic"> Sonic
                <input type="radio" name="series" value="Splatoon"> Splatoon
                <input type="radio" name="series" value="StarFox"> Star Fox
                <input type="radio" name="series" value="StreetFighter"> Street Fighter
                <input type="radio" name="series" value="Wario"> Wario
                <input type="radio" name="series" value="WiiFit"> Wii Fit
                <input type="radio" name="series" value="Xenoblade"> Xenoblade
                <input type="radio" name="series" value="Yoshi"> Yoshi
                <input type="radio" name="series" value="Zelda"> Zelda 
            </form>
            </div>
            <div id="searchBody" class="searchBody">
                
            </div>
        </div>
        <div class="descSection">
            <div class="descImgContainer">
                <img src="img/spiritImages/<?php echo $sid; ?>.png" alt="<?php echo $name; ?>" />
            </div>
        </div>
        <div class="descSection">
            <h2><?php echo $id . " ". $name; ?></h2>
            <div class="descBox primary">
                <p class="descText"><?php echo $description; ?></p>
            </div>
            <div class="descBox secondary">
                <img src="img/seriesIcons/<?php echo $series; ?>.png" alt="<?php echo $series;?>" />
                <p class="descGameText"><?php echo $game; ?> </p>
            </div>
        </div>
    </div>
</body>
<script>
    //this function needs to be updated whenever there is a new total amount of spirits
    const max = 1320;
    function getNextSpirit(id) {
        if(id == max) {
            nextID = 1;
        } else {
            nextID = id + 1;
        }
        let url = `api/spirits/getOne.php?id=${nextID}`;
        let options = {
            method: "GET",
            mode: "cors",
            cache: "no-cache",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json"
            },
            redirect: "follow",
            referrer: "no-referrer"
        };
        return fetch(url, options)
            .then(response => response.json())
            .then(jsonresponse => {
                let sid = Number(jsonresponse.records[0].id);
                let name = jsonresponse.records[0].name;
                responsehtml = `
                    ${sid} ${name} -->
                `;
                document.getElementById('nextSpirit').innerHTML = responsehtml;
            })
            .catch(error => console.error(error));
    }
    function getPreviousSpirit(id) {
        if(id == 1) {
            nextID = max;
        } else {
            nextID = id - 1;
        }
        let url = `api/spirits/getOne.php?id=${nextID}`;
        let options = {
            method: "GET",
            mode: "cors",
            cache: "no-cache",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json"
            },
            redirect: "follow",
            referrer: "no-referrer"
        };
        return fetch(url, options)
            .then(response => response.json())
            .then(jsonresponse => {
                let sid = Number(jsonresponse.records[0].id);
                let name = jsonresponse.records[0].name;
                responsehtml = `<-- ${sid} ${name}`;
                document.getElementById('previousSpirit').innerHTML = responsehtml;
            })
            .catch(error => console.error(error));
    }
    window.onload = function() {
        let sid = <?php echo $id; ?>;
        getNextSpirit(sid);
        getPreviousSpirit(sid);
    }
    function getSpirit(action, id) {
        switch(action) {
            case 'next':   
                spiritID = id + 1;
                break;
            case 'previous':
                spiritID = id - 1;
                break;
            case 'random':
                spiritID = Math.floor(Math.random() * max);
                break;
            default:
                spiritID = id;
                break;
        }
        let url = `api/spirits/getOne.php?id=${spiritID}`;
        let options = {
            method: "GET",
            mode: "cors",
            cache: "no-cache",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json"
            },
            redirect: "follow",
            referrer: "no-referrer",
        };
        return fetch(url, options)
            .then(response => response.json())
            .then(jsonresponse => {
                console.log(jsonresponse.records);
                let id = Number(jsonresponse.records[0].id);
                let name = jsonresponse.records[0].name;
                let game = jsonresponse.records[0].game;
                let series = jsonresponse.records[0].series;
                let description = jsonresponse.records[0].description;
                htmlresponsecode = `
                <div class="descSection">
                    <div class="descImgContainer">
                        <img src="img/spiritImages/${id}.png" alt="${name}" />
                    </div>
                </div>
                <div class="descSection">
                    <h2>${id} ${name}</h2>
                    <div class="descBox primary">
                        <p class="descText">${description}</p>
                    </div>
                    <div class="descBox secondary">
                        <img src="img/seriesIcons/${series}.png" alt="${series}" />
                        <p class="descGameText">${game}</p>
                    </div>
                </div>
                `;
                document.getElementById('descBody').innerHTML = htmlresponsecode;
                document.title = `${name} | Details`;
                document.getElementById('indexLink').setAttribute('href', `index.php?place=${id}`);
                currentID = id;
                getNextSpirit(spiritID);
                getPreviousSpirit(spiritID);
                history.pushState({}, null, `details.php?id=${spiritID}`)
            })
            .catch(error=> console.error(error));
            
    }
    function getDetailsSearchResults() {
        let formData = document.getElementById('searchSettings').elements;
        let sortOptions = "";
        //iterate through options for what to sort by
        for(var a = 0; a < 3; a++) {
            if(formData[a].checked) {
                sortOptions = formData[a].value;
            }
        }
        let seriesOptions = [];
        for(var b = 3; b < formData.length(); b++) {
            if(formData[b].checked) {
                seriesOptions.push(formData[b].value);
            }
        }
        let url = "./api/spirits/detailsSearch.php";
        let options = {
            method: "POST", 
            credentials: "same-origin",
            cache: "no-cache",
            headers: {
                "Content-Type": "application/json"
            },
            body: {
                "sortOrder": sortOptions,
                "seriesFilter": seriesOptions
            }
        }
        return fetch(url, options) 
            .then(res => res.json())
            .then(response => {
                responsehtml = ``;
                response.map(spirit => {
                    responsehtml = responsehtml + `<p onClick="getSpirit("default", ${spirit.id})>${spirit.id} ${spirit.name}</p>`;
                });
                document.getElementById('searchBody').innerHTML = responsehtml;
            })
            .catch(error => console.error(error));
    }
</script>
</html>