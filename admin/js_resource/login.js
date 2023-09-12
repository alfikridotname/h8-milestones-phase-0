const formLogin = document.querySelector('#form-login');

function validasi() {
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    if (username != "" && password != "") {
        return true;
    } else {
        showAlert('Username dan Password tidak boleh kosong!');
        return false;
    }
}

formLogin.addEventListener('submit', (e) => {
    // Prevent Default
    e.preventDefault();

    // Ambil data dari form
    const username = formLogin[ 'username' ].value;
    const password = formLogin[ 'password' ].value;

    // Validasi
    validasi();

    // Ajax POST
    ajaxPost('/module/auth/proses-login.php', `username=${username}&password=${password}`, (result) => {
        const response = JSON.parse(result.responseText);
        if (response.status == true) {
            window.location.href = '?page=home';
        } else {
            showAlert(response.message);
        }
    });
});