function handleDeleteQuestion() {
    let id = document.getElementById('questionID').value;
    let url = 'api/quiz/delete.php';
    let options = {
        method: "POST",
        credentials: "same-origin",
        cache: "no-cache",
        headers: {
            "Content-Type": "application/json"
        },
        body: {
            "id": id
        },
    };
    return fetch(url, options)
        .then(res => res.json())
        .then(response => {
            if(response.record == true) {
                document.getElementById('messageBox').innerHTML = `<p class="message">Deletion Successful</p>`;
            } else {
                document.getElementById('messageBox').innerHTML = `<p class="message">Deletion Failed.  Please Try Again.  If the problem persists, please contact the admin</p>`;
            }
            id = "";
        })
        .catch(error => console.error(error));
}