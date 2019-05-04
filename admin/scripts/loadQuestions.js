function loadQuestions(targets) {
    let url = '../../api/quiz/getAll.php';
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
            jsonresponse.map(question => {
                let rhtml = `<option value='${question.id}'>${question.question}</option`;
                targets.map(target => {
                    document.getElementById(target).innerHTML = document.getElementById(target).innerHTML + rhtml;
                });
            });
        })
        .catch(error => console.error(error));
}