function getAutoResult() {
    let searchValue = document.getElementById('searchText').value;
    let url = `../api/spirits/autoResponse.php?query=${searchValue}`;
    let options = {
        method: "GET",
        mode: "cors",
        cache: "no-cache",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        redirect: "follow",
        referrer: "no-referrer"
    }
    return fetch(url, options)
        .then(response => response.json())
        .then(data => {
            let spiritResults = data.spirits;
            let responsehtml = ``;
            spiritResults.map(spirit => {
                let i = spirit.id;
                let n = spirit.name;
                responsehtml = responsehtml + `<p onClick="getSpirit('default', ${i})">${n}</p>`;
            });
            document.getElementById('searchResults').innerHTML = responsehtml; 
        })
        .catch(error=> console.error(error));
}
function search() {
    let searchValue = document.getElementById('searchText').value;
    let url = `../api/spirits/autoResponse.php?query=${searchValue}`;
    let options = {
        method: "GET",
        mode: "cors",
        cache: "no-cache",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        },
        redirect: "follow",
        referrer: "no-referrer"
    }
    return fetch(url, options)
        .then(response => response.json())
        .then(data => {
            let spiritResults = data.spirits;
            if(spiritResults.length == 1 || spiritResults[0].name.toUpperCase() == searchValue.toUpperCase()) {
                
                getSpirit("default", spiritResults[0].id);
            }
        })
        .catch(error => console.error(error));
}

function callSidebarResults(func, wait, immediate) {
    let timeout;
    return function() {
        let context = this;
        let args = arguments;
        let later = function() {
            timeout = null;
            if(!immediate) {
                func.apply(context, args);
            }
        };
        let callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait || 200);
        if(callNow) {
            func.apply(context, args);
        }
    }
}
function clearSearchResults(e) {
    if(e.target.id != "searchResults") {
        document.getElementById('searchResults').style.display = "none";
        document.getElementById('searchResults').innerHTML = "";
        document.getElementById('searchText').value = "";
    }
}
document.addEventListener('click', clearSearchResults(), false);