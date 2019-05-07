<?php /*
    Objectives Here:
        Bugfix
            There have been reported issues where the quiz game randomly deletes progress.  I have been using cookies for this, but it should probably switch over to sessions.
        Improve Design
            I don't like the design on this page as it is on the site, but I'm not sure what I want instead, so I'm open to suggestions!
        Add a way for random visitors to "suggest" quiz additions, that are moderated by logged-in admins.  (I think it would be pretty similiar to how admins currently add questions, but sending these to a different table in the DB that the admins can then access and then "approve"/"deny" potential questions.
*/
?>



<?php include 'templates/header.php'; ?>
<head>
    <title>Quiz Game | Smash Ultimate Spirits</title>
</head>
<div id="main">
    <div class="quizBody">
        <div id="quizQuestion">Quiz Question Goes Here</div>
        <div id="answers">
        </div>
    </div>
</div>
<script>
    let banList = sessionStorage.getItem('banList');

    function loadQuestion() {
        let url = 'api/quiz/getOne.php';
        let options = {
            method: "POST",
            cache: "no-cache",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json"
            },
            body: {
                "banList": banList
            },

        };
        return fetch(url, options) 
            .then(res => res.json())
            .then(response => {
                //insert quiz html into the appropriate places
                //question id should be stored in session storage
            })
            .catch(error => console.error(error));
    };
    window.onLoad(function(){loadQuestion()});
    function processQuestion() {
        let qid = sessionStorage.getItem('qid');
        let aid = sessionStorage.getItem('aid');
        sessionStorage.setItem('banList', sessionStorage.getItem('banList').push(qid));
        let url = 'api/quiz/process.php';
        let options = {
            method: "POST",
            cache: "no-cache",
            credentials: "same-origin",
            headers: {
                "Content-Type": "application/json"
            },
            body: {
                "qid": qid,
                "aid": aid
            }
        };
        return fetch(url, options)
            .then(res => res.json())
            .then(response => {
                if(response.isRight) {
                    if(sessionStorage.getItem('rightCount') === null) {
                        sessionStorage.setItem('rightCount', 1);
                    } else {
                        sessionStorage.setItem('rightCount', sessionStorage.getItem('rightCount') + 1);
                    }
                    if(sessionStorage.getItem('wrongCount') === null) {
                        sessionStorage.setItem('wrongCount', 0);
                    }
                    responsehtml = `<p class="qMessage">Correct!`;
                } else {
                    if(sessionStorage.getItem('wrongCount') === null) {
                        sessionStorage.setItem('wrongCount', 1);
                    } else {
                        sessionStorage.setItem('wrongCount', sessionStorage.getItem('wrongCount') + 1);
                    }
                    if(sessionStorage.getItem('rightCount') === null) {
                        sessionStorage.setItem('rightCount', 0);
                    }
                    responsehtml = `<p class="qMessage">Wrong!`;
                }
                let rightAnswers = sessionStorage.getItem('rightCount');
                let wrongAnswers = sessionStorage.getItem('wrongCount');
                let totalAnswers = sessionStorage.getItem('rightCount') + sessionStorage.getItem('wrongCount');
                let answerRate = Math.round((rightAnswers / totalAnswers) * 100)
                responsehtml += `  You have answered ${rightAnswers} questions correctly out of ${totalAnswers} questions.  That's ${answerRate}%`;
                switch answerRate {
                    case < 50:
                        responsehtml += `:( </p>`;
                        break;
                    case < 70:
                        responsehtml += `:| </p>`;
                        break;
                    default:
                        responsehtml += `:) </p>`;
                        break;
                }
                document.getElementById('qMessageArea').innerHTML = responsehtml;
                loadQuestion();
            })
            .catch(error => console.error(error));
    }
</script>
<?php include 'templates/footer.php'; ?>