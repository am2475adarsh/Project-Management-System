<?php
//connect to database
$conn = mysqli_connect('localhost', 'adarsh', 'test1234', 'project_mngmt');

//check connection
if (!$conn) {
    echo 'Connection error:' . mysqli_connect_error();
}
