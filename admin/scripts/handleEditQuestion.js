function handleEditQuestion() {
    let id = document.getElementById('questionID').value;
    let question = document.getElementById('qustion').value;
    let corAns = document.getElementById('corAns').value;
    let wrongAns1 = document.getElementById('wrongAns1').value;
    let wrongAns2 = document.getElementById('wrongAns2').value;
    let wrongAns3 = document.getElementById('wrongAns3').value;
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
            "question": question,
            "corAns": corAns,
            "wrongAns1": wrongAns1,
            "wrongAns2": wrongAns2,
            "wrongAns3": wrongAns3
        },
    };
    return fetch(url, options)
        .then(res => res.json())
        .then(response => {
            if(response.record = true) {
                document.getElementById('message').innerHTML = `<p class="message">Edit Successful</p>`;
            } else {
                document.getElementById('message').innerHTML = `<p class="message">Edit Failed.  Please Try Again.  If the problem persists, please contact the admin</p>`;
            }
            id = "";
            question = "";
            corAns = "";
            wrongAns1 = "";
            wrongAns2 = "";
            wrongAns3 = "";
        })
        .catch(error => console.error(error));
}