<?php
include 'dbconn.php';
include 'function.php';

error_reporting(E_ERROR | E_PARSE);

var_dump($_POST);
//Create product
if (isset($_POST['data'])) {


    // $data = json_decode(stripslashes($_POST['data']));
    $example = file_get_contents("php://input");
    $example = json_encode($example);
    // var_dump($example);

    $query = "INSERT INTO test (dates) VALUES ('$example')";
    $query_run = mysqli_query($con, $query);
}
