function getSidebarSpirits(sort, offset, includeArr, yearRange) {
    let includeList;
    let sentOffset;
    let sentSort;
    if(includeArr === undefined || includeArr.length == 0) {
        includeList = "all";
    } else {
        includeList = includeArr;
    }
    if(offset > max - 20) {
        sentOffset = max - 20;
    } else if(offset == max) {
        sentOffset = 0;
    } else {
        sentOffset = offset;
    }
    switch (sort) {
        case "name":
            sentSort = "name";
            break;
        case "game":
            sentSort = "game";
            break;
        case "id":
            sentSort = "id";
            break;
        case "series":
            sentSort = "series";
            break;
        case "release_year":
            sentSort = "release_year";
            break;
        default:   
            sentSort = "id";
            break;
    }
    if (sentSort != "id") {
        sentOffset = 0;
    }
    let url = "../api/spirits/detailsSearch.php";
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
            "sortType": sentSort,
            "offset": sentOffset,
            "includes": includeList,
            "minYear": yearRange[0],
            "maxYear": yearRange[1]
        })
    }
    return fetch(url, options)
        .then(response => response.json())
        .then(data => {
            htmlresponsecode = `<div class="spiritsSidebar">`;
            if(data.message == "No Spirits Found") {
                document.getElementById('searchBody').innerHTML = "";
            } else {
            data.map(item => {
                htmlresponsecode = htmlresponsecode + `
                    <div class="spiritsSidebarItem" onClick="getSpirit('default', ${item.id.toString()})">`
                    //<img src="img/seriesIcons/${item.series}.png" />  commenting out til I style this part of the page, since the images massacre the layout as is
                    +`<p>${item.id} ${item.name} </p>
                    </div>
                `;
            });
            htmlresponsecode = htmlresponsecode + `</div>`;
            document.getElementById('searchBody').innerHTML = htmlresponsecode;
        }
        })
        .catch(error => console.error(error));
}


    let yearSlider = document.getElementById('yearSlider');
    noUiSlider.create(yearSlider, {
        start: [1979, 2019],
        orientation: 'vertical',
        animate: true,
        animationDuration: 350,
        connect: true,
        step: 1,
        tooltips: true,
        range: {
            'min': 1979,
            'max': 2019
        },
        format: {
            to: function( value ) {
                return value + '';
            },
            from: function( value ) {
                return value.replace(',-', '');
            }
        }
    });
    yearSlider.noUiSlider.on('update', throttle(handleSidebarSpiritInput, 500));
    
    function handleSidebarSpiritInput() {
        
        let sortValue;
        let offsetValue;
        let seriesValue = [];
        let yearRangeValue;
        //handle sort inputs
        let inputs = document.getElementById('sortSettings');
        for(var a = 0; a < 4; a++) {
            if(inputs[a].checked) {
                sortValue = inputs[a].value; 
            }
        }
        //handle offset input
        var parts = window.location.search.substr(1).split("&");
        var $_GET = {};
        for (var i = 0; i < parts.length; i++) {
            var temp = parts[i].split("=");
            $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
        }
        if(sortValue != "id") {
            offsetValue = 0;
        }else {
            offsetValue = $_GET.id - 1;
        }
        //handle series input
        for(var b = 4; b < 40; b++) {
            if(inputs[b].checked) {
                seriesValue.push(inputs[b].value);
            }
        }
        //handle year range input
        let minYear = Number(yearSlider.noUiSlider.get()[0]);
        let maxYear = Number(yearSlider.noUiSlider.get()[1]);
        yearRangeValue = [minYear, maxYear];
        
        return throttle(getSidebarSpirits(sortValue, offsetValue, seriesValue, yearRangeValue), 500);
    }


    document.getElementsByClassName("noUi-tooltip").map(item => {
       item.innerHTML = item.innerHTML.slice(0, -3); 
    });
    
    yearSlider.noUiSlider.on('update.a', function() { return callSidebarResults(handleSidebarSpiritInput(), 500, false);});