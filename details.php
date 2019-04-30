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
    $id = $_GET['id'];
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
<body>
    
    <nav>
        <a href="javascript:void(0)" onClick="previousSpirit()"> \<-- previous spirit </a>
        <a href="index.php?place=<?php echo $sid; ?>"> Return to Index </a>
        <a href="javascript:void(0)" onClick="randomSpirit()"> Random Spirit </a>
        <a href="javascript:void(0)" onClick="nextSpirit()"> next spirit --> </a>
    </nav>
    <div class="descBody" id="descBody">
        <div class="descSection">
            <div class="descImgContainer">
                <img src="img/spiritImages/<?php echo $sid; ?>.png" alt="<?php echo $name; ?>" />
            </div>
        </div>
        <div class="descSection">
            <h2><?php echo $name ?></h2>
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
<?php echo "<script>let initId = $sid; </script>";?>
<script>
    let currentSpirit = initId;
    let max = 1320;
    function previousSpirit() {
        if(currentSpirit == 1) {
            currentSpirit = max;
        } else {
            currentSpirit -= 1;
        }
        return getSpirit(currentSpirit);
    }
    function nextSpirit() {
        if(currentSpirit == max) {
            currentSpirit = 1;
        } else {
            currentSpirit += 1;
        }
        return getSpirit(currentSpirit);
    }
    function randomSpirit() {
        currentSpirit = Math.floor(Math.random() * max);
        return getSpirit(currentSpirit);
    }
    function getSpirit(id) {
        if(id == 0) {
            spiritID = Math.floor(Math.random() * max);
        } else {
            spiritID = id;
        }
        let url = "api/spirits/getOne.php";
        let options = {
            method: "POST",
            mode: "cors",
            cache: "no-cache",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json"
            },
            redirect: "follow",
            referrer: "no-referrer",
            body: JSON.stringify({id: spiritID})
        };
        return fetch(url, options)
            .then(response => response.json())
            .then(jsonresponse => {
                let id = jsonresponse.records.id;
                let name = jsonresponse.records.name;
                let game = jsonresponse.records.game;
                let series = jsonresponse.records.series;
                let description = jsonresponse.records.description;
                htmlresponsecode = `
                <div class="descSection">
                    <div class="descImgContainer">
                        <img src="img/spiritImages/${id}.png alt="${name}" />
                    </div>
                </div>
                <div class="descSection">
                    <h2>${name}</h2>
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
            })
    }

    function findAutoResult() {
        let searchValue = document.getElementById('searchValue').value;
        let url = 'api/spirits/autoResponse.php';
        let options = {
            method: "POST",
            mode: "cors",
            cache: "no-cache",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/urlencoded",
            },
            redirect: "follow",
            referrer: "no-referrer",
            body: JSON.stringify({
                query: searchValue
            }),
        }
        return fetch(url, options)
            .then(response => response.json())
            .then(jsonresponse => {
                let spiritResults = jsonresponse.spirits;
                let spiritHtml = `<p class='searchResultHeader'>Spirits</p>`;
                spiritResults.map(spirit => {
                    let i = spirit.id;
                    let n = spirit.name;
                    spiritHtml = spiritHmtl + `<a href=javascript:void(0) onClick='getSpirit(${i})>${n}</a>`;
                });
                document.getElementById('searchResults').innerHTML = spiritHtml;
            });
    }
    function closeSearchResults() {
        document.getElementById('searchResults').innerHTML = "";
    }
    window.addEventListener('click', closeSearchResults, false);
</script>
</html>