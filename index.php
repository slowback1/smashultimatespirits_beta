
<?php /*
        Objectives Here:
            Make the Search Results appear on this page (so it doesnt go to a different page when you search)
            Find a better home for the searchbar (maybe have it on the right column on desktop, anchored to the top on mobile/tablet?)
            Possibly ditch the banner
            Run things through the upcoming API instead of just a PHP page running the outputs (so it no longer runs like in __old/actions/loadMore.php)
            Improve Responsiveness
                Things that need to change from Main site:
                    * Hamburger Button needs to be bigger on smaller screens
                    * Text needs to be bigger on smaller screens
                    * Support for Ultrawide monitors (this probably just means giving the ability to have more than 6 spirits per row)
                    * [ADD MORE HERE]










    NOTE: Some of these things go in templates/header.php and templates/footer.php

 */ ?>
<?php include 'templates/header.php'; ?>

<div id="main" class="main">

</div>
<script>   
    //args are a function, and an integer representing cooldown in ms
    //prevents function from firing repeatedly
   const throttle = (func, limit) => {
       let lastFunc;
       let lastRan;
       return function() {
           const context = this;
           const args = arguments;
           if(!lastRan) {
               func.apply(context,args);
               lastRan = Date.now();
           } else {
               clearTimeout(lastFunc);
               lastFunc = setTimeout(function() {
                   if((Date.now() - lastRan) >= limit) {
                        func.apply(context, args);
                        lastRan = Date.now();        
                   }
               }, limit - (Date.now() - lastRan));
           }
       }
   }
    let numOfSpirits = 0;
    //count is an integer, which represents the offset value required for the api call
    //calls spirits api and adds up to 60 more spiritboxes to the end of the #main div, template for spirit box is in templates/spiritBox.js
    function loadMore(count) {
        if(loadMoreDisabled) {
            return false;
        }
        let url = "";
        //max is found in templates/header.php
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