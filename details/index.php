<?php /*
    Objectives Here:
        refactor all of the js in the scripts folder.  possibly have it follow OOP principles better?  
        more TBA
*/ ?>
<?php
    include_once '../connection/connect.php';
    if ($_GET['id'] == 0) {
        $id = rand(1, 1320);
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
    <?php include './templates/header.php'; ?>
    
    <?php include './templates/sortBar.php'; ?>
    <script>
    //this constant needs to be updated whenever there is a new total amount of spirits
    const max = 1320;    
    window.onload = function() {
        let sid = <?php echo $id; ?>;
        getNextSpirit(sid);
        getPreviousSpirit(sid);
    }
    </script>
    <script src="./external_scripts/nouislider.min.js"></script>
    <script src="./scripts/get_spirit.js"></script>
    <script src="./scripts/search.js"></script>
    <script src="./scripts/details_sidebar.js">getSidebarSpirits("id",<?php echo $id - 1; ?> ,"all", [1979, 2019]);</script>
    <div class="descBody" id="descBody">
        <div class="descSection">
            <div class="descImgContainer">
                <img src="../img/spiritImages/<?php echo $sid; ?>.png" alt="<?php echo $name; ?>" />
            </div>
        </div>
        <div class="descSection">
            <h2><?php echo $id . " ". $name; ?></h2>
            <div class="descBox primary">
                <p class="descText"><?php echo $description; ?></p>
            </div>
            <div class="descBox secondary">
                <img src="../img/seriesIcons/<?php echo $series; ?>.png" alt="<?php echo $series;?>" />
                <p class="descGameText"><?php echo $game; ?> </p>
            </div>
        </div>
    </div>
</body>




</html>