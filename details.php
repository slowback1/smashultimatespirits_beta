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
    <!-- // more stuff goes here -->
    <nav>
        <div onClick="getSpirit('previous', currentID)" class="navArrow" id="previousSpirit"><-- Previous Spirit</div>
        <a href="index.php?place=<?php echo $id; ?>" class="navLink"> Return to Index </a>
        <div onClick="getSpirit('random', 0)" class="navLink"> Random Spirit </a></div>
        <div onClick="getSpirit('next', currentID)" class="navArrow" id="nextSpirit">Next Spirit --></div>
    </nav>
    <div class="descBody" id="descBody">
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
                currentID = id;
                getNextSpirit(spiritID);
                getPreviousSpirit(spiritID);
                history.pushState({}, null, `details.php?id=${spiritID}`)
            })
            .catch(error=> console.error(error));
            
    }
</script>
</html>