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
    <!-- // more stuff goes here -->
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
<script>
    //this function needs to be updated whenever there is a new total amount of spirits
    function getSpirit(id) {
        if(id == 0) {
            spiritID = Math.floor(Math.random() * 1320);
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
</script>
</html>