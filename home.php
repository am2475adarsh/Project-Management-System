<?php
session_start();
include('config/db_connect.php');

$email = $_SESSION['user_email'];

if (isset($_POST['submit'])) {

    // "mysqli_real_escape_string" this helps unwanted or harmful data to get into our database
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $status_details = mysqli_real_escape_string($conn, $_POST['status_details']);

    if (!empty($_POST['status_details'])) {

        $status_details = $_POST['status_details'];
        // echo $status_details;

        $sql = "SELECT id FROM user_details where email= '$email'";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            $user_data = $user_data['id'];

            if ($status_details === 'TODO') {
                $sql = "INSERT INTO todo_list(todo_titles,todo,id) VALUES('$title','$description','$user_data')";
                mysqli_query($conn, $sql);
            } else if ($status_details === 'DOING') {
                $sql = "INSERT INTO doing_list(doing_titles,doing,id) VALUES('$title','$description','$user_data')";
                mysqli_query($conn, $sql);
            } else if ($status_details === 'DONE') {
                $sql = "INSERT INTO done_list(done_titles,done,id) VALUES('$title','$description','$user_data')";
                mysqli_query($conn, $sql);
            }
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];
    $data = $_GET['data'];
    $title = $_GET['title'];
    $status = $_GET['status_edit'];
    $change = $_GET['change'];
    $sql = "SELECT id FROM user_details where email= '$email'";
    $result = mysqli_query($conn, $sql);
    $user_id = mysqli_fetch_assoc($result);
    $user_id = $user_id['id'];

    if (strcmp($change, 'true') == 0) {
        $newCol = $status . '_id';
        $newColTwo = $status . '_titles';
        $sql = "UPDATE `$table` SET `$status`='$data', `id`='$user_id', `$newColTwo`='$title'  where `$newCol` = $id ";
        mysqli_query($conn, $sql);
    } else {
        $newTable = $table;
        $newCol = str_replace('list', 'id', $table);
        $sql = "DELETE FROM `$newTable` where `$newCol` = $id ";
        mysqli_query($conn, $sql);
        $newColTwo = $status . '_list';
        $newCol = $status . '_titles';
        $sql = "INSERT INTO `$newColTwo`(`$newCol`,`$status`,`id`) values('$title', '$data', $user_id) ";
        mysqli_query($conn, $sql);
    }
}


if (isset($_GET['idd'])) {
    $id = $_GET['idd'];
    $table = $_GET['tabled'];
    $newCol = str_replace('list', 'id', $table);
    $sql = "DELETE FROM $table where `$newCol` = $id ";
    // $sql1 = "UPDATE user_details set pass ='$sql' where id = 1 ";
    mysqli_query($conn, $sql);
    // mysqli_query($conn, $sql1);
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
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 1px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #21212d;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #21212d;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #21212d;
        }
    </style>
</head>

<body>
    <section class="panel">
        <div class="panel_title">Institute Management</div>
        <div class="list">

            <div class="details active" id="results" onclick="myfunc(this.id)"><i class="fa fa-pie-chart" aria-hidden="true" style="position: absolute;left:20px;"></i>
                Platform Launch
            </div>
            <div class="details" id="student_det" onclick="myfunc(this.id)"> <i class="fa fa-database" aria-hidden="true" style="position: absolute;left:20px;"></i>Add Details

            </div>
    </section>
    <section class="main" style="background-color: #21212d;">
        <nav>
            <div>Platform Launch</div>
            <div class="new_task" onclick="addFunc()">+ Add New Task</div>
            <form action="logout.php" method="POST" style="display: flex;justify-content:center;align-items:center">
                <div style="position: fixed; right:40px;"><button style="border-radius:100px;width:100px;height:35px;cursor:pointer;">LOGOUT</button> </div>
            </form>
        </nav>

        <div class="wrapper" id="wrappers">

            <?php

            // TODO
            echo "<div class='things'>";
            $sql = "SELECT id FROM user_details where email= '$email'";
            $result = mysqli_query($conn, $sql);
            $user_id = mysqli_fetch_assoc($result);
            $user_id = $user_id['id'];
            $sql = "select * from todo_list where id= $user_id";
            $result = mysqli_query($conn, $sql);
            $lol = mysqli_num_rows($result);
            echo "<div class='dot'></div>&nbsp&nbsp&nbsp<div class='things_title'>TODO ($lol)</div>";
            while ($user_data = mysqli_fetch_assoc($result)) {
                echo "<div class='todo_list lists' onclick='update(`todo_list`," . $user_data['todo_id'] . ");deleted(`todo_list`," . $user_data['todo_id'] . ")'>" . "<span id='" . 'todo_list' . $user_data['todo_id'] . 'a' . "'>" . $user_data["todo_titles"] . "</span>" .  "<p style='font-size:13px; color:#8e90b1;'  id='" . 'todo_list' . $user_data['todo_id'] . "'>" . $user_data["todo"] . '</p>' .  "</div>";
            }
            echo "</div>";

            // DOING
            echo "<div class='things'>";
            $sql = "SELECT id FROM user_details where email= '$email'";
            $result = mysqli_query($conn, $sql);
            $user_id = mysqli_fetch_assoc($result);
            $user_id = $user_id['id'];
            $sql = "select * from doing_list where id = $user_id";
            $result = mysqli_query($conn, $sql);
            $lol = mysqli_num_rows($result);
            echo "<div class='dot' style='background-color:#816fe7'></div>&nbsp&nbsp&nbsp<div class='things_title'>DOING ($lol)</div>";
            while ($user_data = mysqli_fetch_assoc($result)) {
                echo "<div class='doing_list lists' onclick='update(`doing_list`," . $user_data['doing_id'] . ");deleted(`doing_list`," . $user_data['doing_id'] . ")'>" . "<span id='" . 'doing_list' . $user_data['doing_id'] . 'a' . "'>" . $user_data["doing_titles"] . "</span>" .  "<p style='font-size:13px; color:#8e90b1;'  id='" . 'doing_list' . $user_data['doing_id'] . "'>" . $user_data["doing"] . '</p>' .  "</div>";
            }
            echo "</div>";


            // DONE
            echo "<div class='things'>";
            $sql = "SELECT id FROM user_details where email= '$email'";
            $result = mysqli_query($conn, $sql);
            $user_id = mysqli_fetch_assoc($result);
            $user_id = $user_id['id'];
            $sql = "select * from done_list where id = $user_id";
            $result = mysqli_query($conn, $sql);
            $lol = mysqli_num_rows($result);
            echo "<div class='dot' style='background-color:#49c19d'></div>&nbsp&nbsp&nbsp<div class='things_title'>DONE ($lol)</div>";
            while ($user_data = mysqli_fetch_assoc($result)) {
                echo "<div class='done_list lists' onclick='update(`done_list`," . $user_data['done_id'] . ");deleted(`done_list`," . $user_data['done_id'] . ")'>" . "<span id='" . 'done_list' . $user_data['done_id'] . 'a' . "'>" . $user_data["done_titles"] . "</span>" .  "<p style='font-size:13px; color:#8e90b1;'  id='" . 'done_list' . $user_data['done_id'] . "'>" . $user_data["done"] . '</p>' .  "</div>";
            }
            echo "</div>";
            ?>
        </div>

    </section>
    <div class="addtaskcontainer" id="task_container" style="width:47vw;">
        <div class="container" style="width: 500px;height:270px;background-color:#262630; box-shadow:
        4px 4px 10px rgba(0, 0, 0, 0.3),
        inset -4px -4px 10px rgba(67, 67, 67, 0.5),
        inset 4px 4px 10px rgba(0, 0, 0, 0.5);">
            <form style="position:relative" method="post" autocomplete="on">

                <div style="position:relative;height: 25px;width:25px;background-color:#0d0d10;display:flex;justify-content:center;align-items:center;cursor:pointer;top:0px;position:absolute;margin-top:-50px">
                    <div onclick="close_div()" style="font-size:20px ; font-weight:600;color:black;font-family:sans-serif;color:#ff6600ce">X</div>
                </div>

                <!--First name-->
                <div class="box">
                    <label for="title" class="fl fontLabel">Title: </label>
                    <div class="new iconBox">
                        <i class="fa fa-font" aria-hidden="true" style="font-size: 14px;"></i>
                    </div>
                    <div class="fr">
                        <input type="text" name="title" placeholder="Take Coffee Break" class="textBox" autofocus="on" required style="background-color: #0d0d10; color:#ff6600ce;box-shadow:0 0 1px 1px #ff6600ce">
                    </div>
                    <div class="clr"></div>
                </div>


                <!---Email ID---->
                <div class="box" style="margin-top:30px;">
                    <label for="description" class="fl fontLabel"> Description: </label>
                    <div class="fl iconBox"><i class="fa fa-commenting" aria-hidden="true"></i>

                    </div>
                    <div class="fr">
                        <input type="text" required name="description" placeholder="It is always good to take a break." class="textBox" style="background-color: #0d0d10; color:#ff6600ce;box-shadow:0 0 1px 1px #ff6600ce">
                    </div>
                    <div class="clr"></div>
                </div>
                <!--Email ID----->


                <!---Password------>
                <div class="box" style="margin-top:30px">
                    <label for="status" class="fl fontLabel">Tasks: </label>
                    <div class="fl iconBox"><i class="fa fa-tasks" aria-hidden="true"></i>

                    </div>
                    <div class="fr" style="float:left">
                        <select name="status_details" id="status_details" class="textBox" autofocus="on" required style="left:-10px;background-color: #0d0d10; color:#ff6600ce;box-shadow:0 0 1px 1px #ff6600ce">
                            <option value="TODO" style="color: #48bada;">TODO</option>
                            <option value="DOING" style="color:#816fe7">DOING</option>
                            <option value="DONE" style="color:#49c19d">DONE</option>
                        </select>
                    </div>
                    <div class="clr"></div>
                </div>
                <!---Password---->



                <!---Submit Button------>
                <div class="box" style="margin-top:30px">
                    <input type="submit" name="submit" class="submit" value="SUBMIT">
                </div>

            </form>
        </div>
    </div>


    <div class="addtaskcontainer" id="edit_task_container" style="width:47vw;">
        <div class="container" style="width: 500px;height:270px;background-color:#262630; box-shadow:
        4px 4px 10px rgba(0, 0, 0, 0.3),
        inset -4px -4px 10px rgba(67, 67, 67, 0.5),
        inset 4px 4px 10px rgba(0, 0, 0, 0.5);">
            <form style="position:relative" method="post" autocomplete="on">

                <div style="position:relative;height: 25px;width:25px;background-color:#0d0d10;display:flex;justify-content:center;align-items:center;cursor:pointer;top:0px;position:absolute;margin-top:-50px">
                    <div onclick="edit_close_div()" style="font-size:20px ; font-weight:600;color:black;font-family:sans-serif;color:#ff6600ce">X</div>
                </div>

                <!--First name-->
                <div class="box">
                    <label for="title" class="fl fontLabel">Title: </label>
                    <div class="new iconBox">
                        <i class="fa fa-font" aria-hidden="true" style="font-size: 14px;"></i>
                    </div>
                    <div class="fr">

                        <input type="text" name="title" class="textBox" autofocus="on" id="title" required style="background-color: #0d0d10; color:#ff6600ce;box-shadow:0 0 1px 1px #ff6600ce">

                    </div>
                    <div class="clr"></div>
                </div>


                <!---Email ID---->
                <div class="box" style="margin-top:30px;">
                    <label for="description" class="fl fontLabel"> Description: </label>
                    <div class="fl iconBox"><i class="fa fa-commenting" aria-hidden="true"></i>

                    </div>
                    <div class="fr">
                        <input type="text" required name="description" id="descrip" class="textBox" style="background-color: #0d0d10; color:#ff6600ce;box-shadow:0 0 1px 1px #ff6600ce">
                    </div>
                    <div class="clr"></div>
                </div>
                <!--Email ID----->


                <!---Password------>
                <div class="box" style="margin-top:30px">
                    <label for="status" class="fl fontLabel">Tasks: </label>
                    <div class="fl iconBox"><i class="fa fa-tasks" aria-hidden="true"></i>

                    </div>
                    <div class="fr" style="float:left">
                        <select name="status_edit" id="status_edit" class="textBox" autofocus="on" required style="left:-10px;background-color: #0d0d10; color:#ff6600ce;box-shadow:0 0 1px 1px #ff6600ce">
                            <option value="TODO" style="color: #48bada;">TODO</option>
                            <option value="DOING" style="color:#816fe7">DOING</option>
                            <option value="DONE" style="color:#49c19d">DONE</option>
                        </select>
                    </div>
                    <div class="clr"></div>
                </div>
                <!---Password---->



                <!---Submit Button------>
                <div style="margin-top:30px;display: inline-block;left:22%;text-align:center;padding-top:15px;color:#0d0d10;font-size:14px;font-weight:800;" id="edit" class="query_submit">
                    EDIT
                </div>
                <div style="margin-top:30px;display: inline-block;left:27%;text-align:center;color:#0d0d10;font-size:14px;font-weight:800;" id="delete" class="query_submit">
                    DELETE
                </div>

            </form>
        </div>
    </div>

</body>

<script src="script.js"></script>

</html>