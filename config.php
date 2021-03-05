<?php 

// DB Connection

$mysqli = new mysqli("192.185.21.14","ammarnif_ammar","bubbaa11bubbaa","ammarnif_babyregistry");

if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
} else {
    // echo "Success";
}

?>