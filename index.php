<!--
        Objectives Here:
            Make the Search Results appear on this page (so it doesn't go to a different page when you search)
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

-->
<?php include 'templates/header.php'; ?>

<div id="main" class="main">
    
</div>
<script>
    //what to put here
    //  function to load more spirits (keep at 60 at a time?)
    //  function will grab spirits from the api, then build the html and append it to the .main div from the JSON data it recieves
    //  call that function once on window load
    //  call that function everytime the user scrolls near the bottom of the page, use a debouncer or setTimeout() so that the function doesn't get called a bunch of times when the user scrolls down!
</script>


<?php include 'templates/footer.php'; ?>