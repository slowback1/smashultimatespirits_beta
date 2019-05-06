function handleAddQuestion() {
    let question = document.getElementById('question').value;
    let corAns = document.getElementById('corAns').value;
    let wrongAns1 = document.getElementById('wrongAns1').value;
    let wrongAns2 = document.getElementById('wrongAns2').value;
    let wrongAns3 = document.getElementById('wrongAns3').value;
    let url = 'api/quiz/add.php';
    let options = {
        method: "POST",
        credentials: "same-origin",
        cache: "no-cache",
        headers: {
            "Content-Type": "application/json"
        },
        body: {
            "question": question,
            "corAns": corAns,
            "wrongAns1": wrongAns1,
            "wrongAns2": wrongAns2,
            "wrongAns3": wrongAns3
        }
    }
    return fetch(url, options)
        .then(res => res.json())
        .then(response => {
            if(response.record == true) {
                document.getElementById('messageBox').innerHTML = `<p class="message">Addition Successful</p>`;
            } else {
                document.getElementById('messageBox').innerHTML = `<p class="message">Addition Failed.  Please try again, and if the problem persists, please contact the admin</p>`; 
            }
            question = "";
            corAns = "";
            wrongAns1 = "";
            wrongAns2 = "";
            wrongAns3 = "";
        })
        .catch(error => console.error(error));
}