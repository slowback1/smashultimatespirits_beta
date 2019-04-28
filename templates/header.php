<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Super Smash Brothers Ultimate Spirits Directory</title>
    <link rel="stylesheet" href="style/home/index.css">
</head>
<body>
    <header>
        <div class="navImgContainer">
            <img src="" alt="header image" />
        </div>
        <h1>Super Smash Brothers Ultimate Spirits Directory</h1>
    </header>
    <nav>
        <div class="hamburgerContainer">
            <a href="javascript:void(0)" onClick="openSideBar()"><img src="" alt="hamburger Button" id="hamburgerBtn" /></a>
        </div>
        <div class="searchArea">
            <form>
                <input type="text" onKeyup="findAutoResult()" id="searchValue" placeholder="Search" />
                <input type="submit" onSubmit="searchResults()" name="Search" value="Search" />
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

            on(evt, cb) {
                this.evtMap[evt].push(cb);
            }
            off(evt, lcb) {
                this.evtMap[evt].map(handler => handler(data));
            }
            handleTouchStart(evt) {
                this.xDown = evt.touches[0].clientX;
                this.yDown = evt.touches[0].clientY;
            }
            handleTouchEnd(evt) {
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


    function findAutoResult() {

    }


    function searchResults() {

    }
</script>