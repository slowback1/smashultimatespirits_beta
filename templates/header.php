<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Super Smash Brothers Ultimate Spirits Directory</title>
    <link rel="stylesheet" href="style/home/index.css">
</head>
<body>
    <header id="header">
        <div class="navImgContainer">

        </div>
        <h1>Super Smash Brothers Ultimate Spirits Directory</h1>
    </header>
    <nav id="nav">
        <div class="hamburgerContainer">
            <a href="javascript:void(0)" onClick="openSideBar()"><img src="img/hamburger.png" alt="hamburger Button" id="hamburgerBtn" /></a>
        </div>
        <div class="searchArea">
            <form onSubmit="search('name', document.getElementById('searchValue').value)">
                <input type="text" onKeyup="findAutoResult()" id="searchValue" placeholder="Search" />
                <input type="submit"  name="Search" value="Search" />
            </form>
            <div class="searchResults" id="searchResults">

            </div>
        </div>
    </nav>
    <div class="sidebar" id="sidebar">
        <!-- things need to go here -->
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
            document.getElementById('sidebar').style.display = "block";
            isOpen = false;
        } else {
            document.getElementById('sidebar').style.display = "hidden";
            isOpen = true;
        }
    }
    document.getElementById('hamburgerBtn').addEventListener('click', toggleSidebar(), false);

    class SwipeEventDispatcher {
        constructor(element, options = {}) {
            this.evtMap = {
                SWIPE_LEFT: [],
                SWIPE_UP: [],
                SWIPE_DOWN: [],
                SWIPE_RIGHT: []
            };
            this.xDown = null;
            this.yDown = null;
            this.options = Object.assign({triggerPercent: 0.3}, options);

            element.addEventListener('touchstart', evt => this.handleTouchStart(evt), false);
            element.addEventListener('touchend', evt => this.handleTouchEnd(evt), false);


            handleTouchStart(evt) => {
                this.xDown = evt.touches[0].clientX;
                this.yDown = evt.touches[0].clientY;
            }
            handleTouchEnd(evt) => {
                const deltaX = evt.changedTouches[0].clientX - this.xDown;
                const deltaY = evt.changedTouches[0].clientY - this.yDown;
                const distMoved = Math.abs(Math.abs(deltaX) > Math.abs(deltaY) ? deltaX : deltaY);
                const activePct = distMoved / this.element.offsetWidth;

                if(activePct > this.options.triggerPercent) {
                    if(Math.abs(deltaX) > Math.abs(deltaY)) {
                        deltaX < 0 ? this.trigger('SWIPE_LEFT') : this.trigger('SWIPE_RIGHT');
                    } else {
                        deltaY < 0 ? this.trigger('SWIPE_DOWN') : this.trigger('SWIPE_UP');
                    }
                }
            }
        }
    }

    const dispatcher = new SwipeEventDispatcher(document.getElementById('main')); //needs a better home than the entire main div  Possible solution: make an invisible div that sits on the left half of the screen that anchors this swipe handler
    dispatcher.on('SWIPE_RIGHT', () => {if(!isOpen){toggleSideBar()}});
    dispatcher.on('SWIPE_LEFT', () => {if(isOpen){toggleSideBar()}});
    let isActive = false;
    function checkNav() {
        let target = document.getElementById('nav');
        if(window.scrollY > (target.offsetTop + target.offsetHeight) && !isActive) {
            target.classList.add('gluedToTop');
            isActive = true;
        } else if (window.scrollY > document.getElementById('header').offsetTop + document.getElementById('header').offsetHeight) {
            target.classList.remove('gluedToTop');
            isActive = false;
        }
    }
    window.addEventListener('scroll', checkNav(), false);

    function findAutoResult() {
        let searchValue = document.getElementById('searchValue').value;
        let url = 'api/spirits/autoResponse.php';
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
                query: searchValue
            }),
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