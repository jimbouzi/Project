<?php

require 'dbfile.php';

$sql = "DELETE FROM activity";
mysqli_query($conn, $sql);

$sql = "DELETE FROM userdata";
mysqli_query($conn, $sql);

$sql = "UPDATE users SET score = 0, lastupload = NULL";
mysqli_query($conn, $sql);

header("Location: ../admin.php");
