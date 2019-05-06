function handleEditSpirit() {
    let id = document.getElementById('spiritID').value;
    let name = document.getElementById('spiritName').value;
    let game = document.getElementById('spiritGame').value;
    let series = document.getElementById('spiritSeries').value;
    let description = document.getElementById('spiritDescription').value;
    let author = document.getElementById('spiritAuthor').value;
    let url = 'api/spirits/edit.php';
    let options = {
        method: "POST",
        credentials: "same-origin",
        cache: "no-cache",
        headers: {
            "Content-Type": "application/json"
        },
        body: {
            "id": id,
            "name": name,
            "game": game,
            "series": series,
            "description": description,
            "author": author
        },
    };
    return fetch(url, options)
        .then(res => res.json())
        .then(response => {
            if(response.record == true) {
                document.getElementById('messageBox').innerHTML = `<p class="message">Edit Successful</p>`;
            } else {
                document.getElementById('messageBox').innerHTML = `<p class="message">Edit Failed.  Please Try Again.  If the problem persists, please contact the admin</p>`;
            }
            id = "";
            name = "";
            game = "";
            series = "";
            description = "";
            author = "";
        })
        .catch(error => console.error(error));
}