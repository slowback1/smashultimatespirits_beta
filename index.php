<?php /*

    TODO: Find a better home for the searchbar (maybe have it on the right column on desktop, anchored to the top on mobile/tablet?)
    TODO: Possibly bring back te banner
    TODO: Run things through the upcoming API instead of just a PHP page running the outputs (so it no longer runs like in __old/actions/loadMore.php)
    TODO: Text needs to be bigger on smaller screens
    TODO: Support for Ultrawide monitors (this probably just means giving the ability to have more than 6 spirits per row)
    BUG: when returning to index from details, spirits are listed starting from last viewed spirit, and you can't scroll up to view earlier spirits.
    BUG: search bar is pretty fucky right now

    NOTE: Some of these things go in templates/header.php and templates/footer.php

 */ ?>

<?php include 'templates/header.php'; ?>

<div id="main" class="main">

</div>
<script>
    let numOfSpirits = 0;
    //calls spirits api and adds up to 60 more spiritboxes to the end of the #main div, template for spirit box is in templates/spiritBox.js
    //arg count: the offset value for the spirits that need to be loaded
    //TODO: if possible, load number of spirits based on scroll speed? or something similar
    function loadMore(count) {
        if(loadMoreDisabled) {
            return false;
        }
        let url = "";
        //max is found in main.js and imported through header.php
        if(count >= max) {
            url = `./api/spirits/getSome.php?limit=60?offset=0`;
            numOfSpirits = 0;
        } else {
            url = `./api/spirits/getSome.php?limit=60&offset=${count}`;
        }
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
                jsonresponse.map(spirit => {
                    document.getElementById('main').innerHTML = document.getElementById('main').innerHTML + spiritBox(spirit.id, spirit.name, spirit.series);
                })
            })
            .catch(error => console.error(error));
    }
    //num is an integer, this should only be called using the global variable numOfSpirits, which is updated in the function
    function callLoadMore(num) {
        numOfSpirits += 60;
        return loadMore(num)
    }
    //calls the callLoadMore function with a throttle, so it doesn't fire a bunch of times at once
    function checkIfAtBottom() {
        if((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 250) {
            throttle(callLoadMore(numOfSpirits), 2500);
        }
    }
    //decode GET parameters on load
    var parts = window.location.search.substr(1).split("&");
        var $_GET = {};
        for (var i = 0; i < parts.length; i++) {
            var temp = parts[i].split("=");
            $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
        }
    //initialize the #main div on pageload
    if(!isNaN($_GET.place)) {
        throttle(callLoadMore($_GET.place - 1));
        numOfSpirits = Number($_GET.place) + 59;
        document.addEventListener('scroll', function(){setTimeout(checkIfAtBottom(), 1500)}, false);
    } else if($_GET.Search) {
        //search function is in templates/header.php
        search("name", $_GET.Search);
    } else {
        throttle(callLoadMore(0), 2500);
        document.addEventListener('scroll', function(){setTimeout(checkIfAtBottom(), 1500)}, false);
    }
</script>


<?php include 'templates/footer.php'; ?>
