<?php

require 'dbfile.php';



$sql = "DELETE FROM activity";
$result = $conn->query($sql);

$sql = "DELETE FROM userdata";
$result = $conn->query($sql);
header("Location: ../admin.php");
