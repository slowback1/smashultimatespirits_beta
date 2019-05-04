<?php include 'templates/adminHeader.php'; ?>

<script>
    function changeState(givenState) {
        switch(givenState) {
            case 'addSpirit':
                let state = "addSpirit";
                responsehtmlcode = addSpirit;
                break;
            case 'editSpirit':
                let state = "editSpirit";
                responsehtmlcode = editSpirit;
                break;
            case 'deleteSpirit':
                let state = "deleteSpirit";
                responsehtmlcode = deleteSpirit;
                break;
            case 'addQuestion':
                let state = "addQuestion";
                responsehtmlcode = addQuestion;
                break;
            case 'editQuestion':
                let state = "editQuestion";
                responsehtmlcode = editQuestion;
                break;
            case 'deleteQuestion':
                let state = "deleteQuestion";
                responsehtmlcode = deletequestion;
                break;
            default:
                let state = "home";
                responsehtmlcode = home;
                break;
        }
        history.pushState({}, null, `index.php?state=${state}`);
        document.getElementById('main').innerHTML = responsehtmlcode;
    }
    var parts = window.location.search.substr(1).split("&");
        var $_GET = {};
        for (var i = 0; i < parts.length; i++) {
            var temp = parts[i].split("=");
            $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
        }
    window.onload(changeState($_GET.state));
</script>


<?php include 'templates/adminFooter.php'; ?>