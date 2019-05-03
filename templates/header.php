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
            <form onSubmit="search('name', document.getElementById('searchValue').value)">
                <input type="text" onKeyup="findAutoResult()" id="searchValue" placeholder="Search" />
                <input type="submit"  name="Search" value="Search" />
            </form>
            <div class="searchResults" id="searchResults">

            </div>
        </div>
        <div class="invisible">

        </div>
    </nav>
    <div class="sidebar" id="sidebar">
        <!-- things need to go here -->
        <p>Test</p>
    </div>
<script>
    //functions that go here:
    // findAutoResult():
    //    takes value from #searchValue and sends it the autoResult api, which returns a JSON object containing search results, seperated by spirit, game, and series
    //    use the resulting JSON object to build html that goes into the #searchResults div
    //    also have an event listener that when the user clicks anywhere outside of the searchResults div, the searchResults returns to being an empty div
    // searchResults():
    //  takes value from #searchValue and sends it to the search api, which returns a JSON object containing search results
    //  use these results to REPLACE the contents in the #main div with html built from the JSON object
    //  also append a button to go back to the regular "main" screen (IE, how it is when the page first loads).
    //

    let isOpen = false;
    function toggleSidebar() {
        if(isOpen) {
            document.getElementById('sidebar').style.display = "none";
            isOpen = false;
        } else {
            document.getElementById('sidebar').style.display = "block";
            isOpen = true;
        }
    }
    document.getElementById('hamburgerBtn').addEventListener('click', toggleSidebar(), false);
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


    let isActive = false;
    function checkNav() {
        let target = document.getElementById('nav');
        if(window.scrollY > 200 && !isActive) {
            target.classList.add('gluedToTop');
            isActive = true;
        } else if(window.scrollY <= 200 ** isActive) {
            target.classList.remove('gluedToTop');
            isActive = false;
        }
    }
    document.addEventListener("scroll", function(){checkNav()});
    function findAutoResult() {
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
                document.getElementById('searchResults').innerHTML = spiritHtml + gameHtml + seriesHtml;
            })
    }


    function search(type, query) {
        const url = './api/spirits/search.php';
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
            body: JSON.stringify({
                searchType: type,
                searchQuery: query
            }),
        }
        return fetch(url, options)
            .then(response => response.json())
            .then(jsonresponse => {
                document.getElementById('main').innerHTML = "";
                jsonresponse.map(spirit => {
                    let id = spirit.id;
                    let name = spirit.name;
                    let series = spirit.series;
                    let rhtml = `
                        <div class='spiritBox'>
                            <div class='spiritImgContainer'>
                                <img src='img/spiritImages/${id}.png' alt='${name}' />
                            </div>
                            <div class='lowerBox'>
                                <img src='img/seriesImages/${series}.png' alt='${series}' />
                                <p> ${id} ${name} </p>
                            </div>
                        </div>
                    `;
                    document.getElementById('main').innerHTML = document.getElementById('main').innerHTML + rhtml;
                });
            });
    }
</script>