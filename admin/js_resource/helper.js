// Funtion Ajax POST
function ajaxPost(url, data, callback) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            callback(this);
        }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(data);
}

// Show Alert
function showAlert(message) {
    const alertDiv = document.querySelector('#alert');
    alertDiv.classList.remove('d-none');
    alertDiv.style.display = 'block';
    alertDiv.innerHTML = message;
    setTimeout(() => {
        alertDiv.style.display = 'none';
    }, 3000);
}
