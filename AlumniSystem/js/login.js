document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loginform').addEventListener('submit', function(event) {
        event.preventDefault();
        const usernum = document.getElementById('userNum').value;
        const userpass = document.getElementById('userPass').value;
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            if (this.status === 200) {
                console.log(this.responseText);
                if (this.responseText == 'admin' || this.responseText == 'student') {
                        const toast = new bootstrap.Toast(document.getElementById('successToast'), {
                            animation: true,
                            autohide: true,
                            delay: 3000
                        });
                        toast.show();
                        setTimeout(function() {
                            document.getElementById('loginform').submit();
                        }, 1000);
                } else {
                    const toast = new bootstrap.Toast(document.getElementById('errorToast'), {
                        animation: true,
                        autohide: true,
                        delay: 3000
                    });
                    toast.show();
                    console.log('Form submission prevented.');
                }
            }
        };

        xhttp.open("POST", "../includes/checkcred.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`userNum=${encodeURIComponent(usernum)}&userPass=${encodeURIComponent(userpass)}`);
    });
});    