<?php
session_start();
include('config/db_connect.php');



if (isset($_POST['submit'])) {

    // "mysqli_real_escape_string" this helps unwanted or harmful data to get into our database
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    $sql = "SELECT * FROM user_details where email= '$email'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        if ($user_data['email'] == $email && $user_data['pass'] == $password) {
            $email = $_SESSION['user_email'] = $_POST['email'];
            $password = $_SESSION['user_password'] = $_POST['password'];
            header('location: home.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
</head>

<body style="background: url(http://wrbbradio.org/wp-content/uploads/2016/10/grey-background-07.jpg) no-repeat center fixed;
    background-size: cover;
    display: flex;
    overflow: hidden;">
    <section class="main" style="width: 100%;display:flex;justify-content:center;align-items:center">
        <div class="container" style="height:150px">
            <form method="post" autocomplete="on">


                <!---Email ID---->
                <div class="box">
                    <label for="email" class="fl fontLabel"> Email ID: </label>
                    <div class="fl iconBox"><i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="fr">
                        <input type="text" required name="email" placeholder="Email ID : " class="textBox">
                    </div>
                    <div class="clr"></div>
                </div>
                <!--Email ID----->


                <!---Password------>
                <div class="box">
                    <label for="password" class="fl fontLabel">Password: </label>
                    <div class="fl iconBox"><i class="fa fa-key" aria-hidden="true"></i>
                    </div>
                    <div class="fr">
                        <input type="password" required name="password" placeholder="password" class="textBox">
                    </div>
                    <div class="clr"></div>
                </div>
                <!---Password---->



                <!---Submit Button------>
                <div class="box" style="background: #2d3e3f">
                    <input type="submit" name="submit" class="submit" value="SUBMIT">
                </div>

                <div class="box">

                    <a href="index.php" style="left: 52%;position: relative; text-decoration:none;color:#ff3002">Click to Sign up</a>
                </div>

            </form>
        </div>
    </section>
</body>

</html>