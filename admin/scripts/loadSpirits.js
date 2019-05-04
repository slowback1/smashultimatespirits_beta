function loadSpirits(targets) {
    let url = '../../api/spirits/getAll.php';
    let options = {
        method: "GET",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json"
        }
    };
    return fetch(url, options)
        .then(response => response.json())
        .then(jsonresponse => {
            jsonresponse.map(spirit => {
                let rhtml = `<option value='${spirit.id}'>${spirit.name}</option>`;
                targets.map(target => {
                    document.getElementById(target).innerHTML = document.getElementById(target).innerHTML + rhtml;
                });
            });
        })
        .catch(error => console.error(error));
}