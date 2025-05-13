<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni System | Login</title>
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"/>
</head>
<body class = "login-body">
    <div class="loginBox"> <img class="user" src="images/logo.png" height="125px" width="125px">
        <h3>Alumni System<br>Sign-in</h3>
        <form action="includes/login.php" id="loginform" method="post" autocomplete="off">
            <div class="inputBox"> 
                <input type="number" name="userNum" id="userNum" placeholder="ID Number" required> 
                <input type="password" name="userPass" id="userPass" placeholder="Passcode" required> 
            </div> 
                <input type="submit" id="submitbtn" value="Sign in">
        </form> 
        <a href="#">Forgot Password?<br> </a>
        <div class="text-center">
            <a href="#" style="color: #558B2F;">Contact Us</a>
            <a href="register.php" >Register Here</a>
            <br>
        </div>  
    </div>


<div class="notif-pops" id="notifs">
    <div class="toast-container position-relative top-30 p-2 w-100% margin-0">
        <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Success! Redirecting...
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto redbutton" data-bs-dismiss="toast" aria-label="Close"><div class="xButton"><p style="color: white;">&times;</p></div></button>
            </div>
        </div>

        <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Invalid ID Number or Passcode!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto redbutton" data-bs-dismiss="toast" aria-label="Close"><div class="xButton"><p style="color: white;">&times;</p></div></button>
            </div>
        </div>
    </div>
</div>

</body>

<script src="js/login.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>



