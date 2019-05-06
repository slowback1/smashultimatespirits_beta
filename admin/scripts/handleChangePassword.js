function handleChangePassword() {
    let oldPassword = document.getElementById('oldPassword').value;
    let password = document.getElementById('password').value;
    let password2 = document.getElementById('password2').value;
    let url = 'api/users/changePassword.php';
    let options = {
        method: "POST",
        credentials: "same-origin",
        cache: "no-cache",
        headers: {
            "Content-Type": "application/json"
        },
        body: {
            "oldPassword": oldPassword,
            "password": password,
            "password2": password2
        }
    };
    return fetch(url, options)
        .then(res => res.json())
        .then(response => {
            if(response.record == true) {
                
            } else {
                document.getElementById('messageBox').innerHTML = `<p class="message">Password Change Failed.  Make sure all of the information is correct.</p>`;
            }
        })
        .catch(error => console.error(error));
}