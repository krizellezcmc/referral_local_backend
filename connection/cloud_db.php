<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

$cloud_db = mysqli_connect("sql624.main-hosting.eu", "u305484025_zcmc_referral", "Zcmc_referral123","u305484025_zcmc_referral");

if($cloud_db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>