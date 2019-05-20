<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Super Smash Brothers Ultimate Spirits Directory</title>
    <link rel="stylesheet" href="style/home/index.css">
</head>
<body>
    <header id="header">
        
        <h1>Super Smash Brothers Ultimate Spirits Directory</h1>
    </header>
    <nav id="nav">
        <div class="hamburgerContainer">
            <a href="javascript:void(0)" onClick="toggleSidebar()"><img src="img/hamburger.png" alt="hamburger Button" id="hamburgerBtn" /></a>
        </div>
        <div class="searchArea">
            <form onSubmit="handleSearch()">
                <input type="text" onKeyup="findAutoResult()" autocomplete="off" name="searchValue" id="searchValue" placeholder="Search" />
                <input type="submit"  name="Search" />
            </form>
            <div class="searchResults" id="searchResults">

            </div>
        </div>
        <div class="invisible">

        </div>
    </nav>
    <div class="sidebar" id="sidebar">
        <!-- things need to go here -->
        <a class="closeBtn" href="javascript:void(0)" onClick="toggleSidebar()">&#10005;</a>
        <a class="sidebarLink" href="details.php?id=0">Random Spirit</a>
        <a class="sidebarLink" href="quiz.php">Quiz Game</a>
        <a class="sidebarLink" href="credits.php">Site Credits</a>
        <?php
            $isLoggedIn = false;
            if(isset($_COOKIE['adminToken'])) {
                $sql = "SELECT username FROM users WHERE username='".$_COOKIE['adminToken']."'";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if($row['username'] == $_COOKIE['adminToken']) {
                            $isLoggedIn = true;
                        }
                    }
                }
            }
            if($isLoggedIn) {
                echo "
                    <div class='adminSeperator'></div>
                    <a class='sidebarLink' href='admin/addSpirit.php'>Add Spirit</a>
                    <a class='sidebarLink' href='admin/editSpirit.php'>Edit Spirit</a>
                    <a class='sidebarLink' href='admin/deleteSpirit.php'>Delete Spirit</a>
                    <a class='sidebarLink' href='admin/addQuestion.php'>Add Question</a>
                    <a class='sidebarLink' href='admin/editQuestion.php'>Edit Question</a>
                    <a class='sidebarLink' href='admin/deleteQuestion.php'>Delete Question</a>
                    <div id='remainingSpirits'>

                    </div>
                    <div class='loginArea'>
                        <a href='admin/changePassword.php'> Change Password </a>
                        <a href='actions/logout.php'> Log Out </a>
                    </div>
                ";
            } else {
                echo "
                    <div id='remainingSpirits'>

                    </div>
                    <div class='loginArea'>
                        <a href='admin/login.php'> Admin Login </a>
                    </div>
                ";
            }
        ?>
        
    </div>
<script>
    const maxSpirits = 1320;
    function getRemainingSpirits() {
        let url = 'api/spirits/count.php';
        let options = {
            method: "GET",
            mode: "cors",
            cache: "no-cache",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/urlencoded"
            },
            redirect: "follow",
            referrer: "no-referrer",

        }
        return fetch(url, options)
            .then(response => response.json())
            .then(jsonresponse => {
                let responsehtmlcode
                if(jsonresponse.records.count >= maxSpirits) {
                    responsehtmlcode = `
                        <p>All ${maxSpirits} spirits are accounted for!</p>
                    `;
                } else {
                    responsehtmlcode = `
                        <p>${jsonresponse.records.count} Spirits accounted for.</p>
                        <p>${maxSpirits - jsonresponse.records.count} Spirits Remain.</p>
                    `;
                }
                document.getElementById('remainingSpirits').innerHTML = responsehtmlcode;
            })
    }
    setTimeout(function(){getRemainingSpirits()}, 500);
    let isOpen = false;
    function toggleSidebar() {
        if(isOpen) {
            document.getElementById('sidebar').style.width = "0";
            setTimeout(function(){document.getElementById('sidebar').style.display = "none"}, 500);
            isOpen = false;
        } else {
            setTimeout(function(){document.getElementById('sidebar').style.width = "196px"}, 100);
            document.getElementById('sidebar').style.display = "flex";
            isOpen = true;
        }
    }
    document.getElementById('hamburgerBtn').addEventListener('onclick', function(){toggleSidebar()}, false);
    document.addEventListener('touchstart', handleTouchStart, false);
    document.addEventListener('touchmove', handleTouchMove, false);

    var xDown = null;
    var yDown = null;

    function getTouches(e) {
        return e.touches || e.originalEvent.touches;
    }
    function handleTouchStart(e) {
        const firstTouch = getTouches(e)[0];
        xDown = firstTouch.clientX;
        yDown = firstTouch.clientY;
    };
    function handleTouchMove(e) {
        if(!xDown || !yDown) {
            return;
        }
        var xUp = e.touches[0].clientX;
        var yUp = e.touches[0].clientY;

        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;

        if(Math.abs(xDiff) > Math.abs(yDiff)) {
            if(xDiff > 0) {
                if(isOpen) {
                    toggleSidebar();
                }
            } else {
                if(!isOpen) {
                    toggleSidebar();
                }
            }
        }
        xDown = null;
        yDown = null;
    }


    let navIsTop = false;
    function checkNav() {
        let target = document.getElementById('nav');
        if(window.scrollY > 200 && !navIsTop) {
            target.classList.add('gluedToTop');
            navIsTop = true;
        } else if (window.scrollY <= 200 && navIsTop) {
            target.classList.remove('gluedToTop');
            navIsTop = false;
        }
    }
    document.addEventListener('scroll', function(){checkNav()});
    let searchText = "";
    function findAutoResult() {
        searchText = document.getElementById('searchValue.value');
        let searchValue = document.getElementById('searchValue').value;
        let url = `api/spirits/autoResponse.php?query=${searchValue}`;
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
            
        }
        return fetch(url, options)
            .then(response => response.json())
            .then(jsonresponse => {
                let spiritResults = jsonresponse.spirits;
                let gameResults = jsonresponse.game;
                let seriesResults = jsonresponse.series;
                let spiritHtml = `<p class='searchResultHeader'>Spirits</p>`;
                spiritResults.map(spirit => {
                    let i = spirit.id;
                    let n = spirit.name;
                    spiritHtml = spiritHtml + `<a href='details.php?id=${i}'>${n}</a>`;
                });
                let gameHtml = `<p class='searchResultHeader'>Games</p>`;
                gameResults.map(game => {
                    let g = game.game;
                    gameHtml = gameHtml + `<a href=javascript:void() onClick='search('game',${g})> ${g} </a>`;
                });
                let seriesHtml = `<p class='searchResultHeader'>Series</p>`;
                seriesResults.map(series => {
                    let s = series.series;
                    seriesHtml = seriesHtml + `<a href=javascript:void() onClick='search('series', ${s})> ${s} </a>`;
                });
                document.getElementById('searchResults').style.display = "flex";
                document.getElementById('searchResults').innerHTML = spiritHtml + gameHtml + seriesHtml;
            })
            .catch(error => console.error(error));
    }


    function search(type, query) {
        const url = `./api/spirits/search.php?searchType=${type}&searchQuery=${query}`;
        let options = {
            method: "GET",
            mode: "cors",
            cache: "no-cache",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/urlencoded"
            },
            redirect: "follow",
            referrer: "no-referrer",
            
        }
        return fetch(url, options)
            .then(response => response.json())
            .then(jsonresponse => {
                document.getElementById('main').innerHTML = "";
                let response = '';
                jsonresponse.map(spirit => {
                    let id = spirit.id;
                    let name = spirit.name;
                    let series = spirit.series;
                    let rhtml = `
                    <div class='spiritBox'>
                    <a href="details.php?id=${id}">
                        <div class='spiritImgContainer'>
                            <img src='img/spiritImages/${id}.png' alt='${name}' />
                        </div>
                        <div class='lowerBox'>
                            <img src='img/seriesIcons/${series}.png' alt='${series}' />
                            <p> ${id} ${name} </p>
                        </div>
                        </a>
                    </div>
                    `;
                    response = response + rhtml;
                });
                document.getElementById('main').innerHTML = response;
            });
    }
    function handleSearch() {
        let type = "name";
        let value = document.getElementById('searchValue').value;
        history.pushState({}, null, `index.php?Search=${value}`);
        return search(type, value);
    }
    function clearSearchResults(e) {
        if(e.target.id != 'searchResults') {
            document.getElementById('searchResults').style.display = "none";
            document.getElementById('searchResults').innerHTML = "";
            document.getElementById('searchValue').value = "";
        }
    }
    document.addEventListener('click', clearSearchResults, false);
    
</script>