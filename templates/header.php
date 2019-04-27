<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Super Smash Brothers Ultimate Spirits Directory</title>
    <link rel="stylesheet" href="style/home/index.css">
</head>
<body>
    <div class="header">
        <div class="navImgContainer">
            <img src="" alt="header image" />
        </div>
        <h1>Super Smash Brothers Ultimate Spirits Directory</h1>
    </div>
    <nav>
        <div class="hamburgerContainer">
            <a href="javascript:void(0)" onClick="openSideBar()"><img src="" alt="hamburger Button" /></a>
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
        
    </div>
<script>
    //functions that go here:
    // openSideBar():
    //  Opens the (by default hidden) sidebar.  simple DOM manipulation
    //  also add an event listener to call openSideBar() when the user swipes right on touchscreen devices
    // closeSideBar():
    //  closes the sidebar.
    //  also add an event listener to call closeSideBar() when the user swipes left on touchscreen devices
    // findAutoResult():
    //    takes value from #searchValue and sends it the autoResult api (not yet implemented), which returns a JSON object containing search results, seperated by spirit, game, and series
    //    use the resulting JSON object to build html that goes into the #searchResults div
    //    also have an event listener that when the user clicks anywhere outside of the searchResults div, the searchResults returns to being an empty div
    // searchResults():
    //  takes value from #searchValue and sends it to the search api (not yet implemented), which returns a JSON object containing search results 
    //  use these results to REPLACE the contents in the #main div with html built from the JSON object
    //  also append a button to go back to the regular "main" screen (IE, how it is when the page first loads).  
    // 
</script>