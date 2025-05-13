<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni System | Register</title>
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"/>
</head>
<body class = "login-body">
    <div class="RegBox"> 
        <div class="logo-name-div">
            <div><img src="images/logo.png"></div>
            <div><h3>Alumni System<br>Sign-up</h3></div>
        </div>
        <form id="regform" method="post" autocomplete="off">
            <div class="inputBox"> 
                <input type="text" name="userName" id="userName" placeholder="First Name" autocomplete="off" required>  
                <input type="text" name="userMName" id="userMName" placeholder="Middle Name" autocomplete="off" required>
                <input type="text" name="userLName" id="userLName" placeholder="Last Name" autocomplete="off" required>
                <div class="flexbreak"></div>
                <input type="email" name="userEmail" id="userEmail" placeholder="E-mail" autocomplete="off" required>
                
                <input type="text" name="sex" id="sex" placeholder="Sex ('M' or 'F')" autocomplete="off" required>
                <input type="date" name="bdate" id="bdate" placeholder="Birthdate" autocomplete="off" required>
                
                <input type="number" name="oldID" id="oldID" placeholder="Old Student ID" autocomplete="off" required>
                <input type="number" name="gradyear" id="gradyear" placeholder="Graduation Year" autocomplete="off" required>
                
                <input type="text" name="dept" id="dept" placeholder="Department" autocomplete="off" required>
                <input type="text" name="prog" id="prog" placeholder="Program" autocomplete="off" required>
                
                <input type="password" name="userPassReg" id="userPassReg" placeholder="Passcode" autocomplete="off" required> 
                <input type="password" name="CuserPass" id="CuserPass" placeholder="Confirm Passcode" autocomplete="off" required> 
            </div> 
            <input type="submit" id="submitbtnreg" value="Sign Up">
        </form>
        <p class="promptMsg">The submitted information would be checked by the PLMun Registrar for Approval. You will receive a confirmation Email containing your Alumni ID for the website once you registration is approved and confirmed.</p><nobr>
        
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
        <?php include 'includes/Register2.php' ?>
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



