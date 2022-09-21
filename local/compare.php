<?php

    include '../connection/cloud_db.php';
    include './functions.php';
    include './get_bizbox.php';

    // $url = "https://sheetsu.com/apis/v1.0su/5d8d23903d6b";
    // $url = "http://gsx2json.com/api?id=1oDT5VTWSfpUsVqV_514_Okp2j5Z0A4XScFwxSsJK0Rg&sheet=data_api&columns=false";
    $url = "https://opensheet.elk.sh/1oDT5VTWSfpUsVqV_514_Okp2j5Z0A4XScFwxSsJK0Rg/data_api";

    $data = json_decode(file_get_contents($url));

    $sheetsData = $data;
    $newData = array();

    foreach($sheetsData as $key1 => $gs_val) {
        // Store names in an array
        $fullname = $gs_val->Lastname.", ".$gs_val->Firstname." ".$gs_val->Middlename." ";
        $date = strtotime($gs_val->Timestamp);
        $referreddate = date("Y/m/d", $date);
        array_push($newData, array('patientname' => $fullname, 'referreddate' => $referreddate));
    }

    $result = [];

    // Compare $bb_array(bizbox) patientname and $newData names
    foreach($bb_array as $key => $value){
        if(is_in_array($newData, "patientname", strtoupper($value['patientname'])) == strtoupper($value['patientname'])) {

            if ($value['referreddate'] != null) {
                $refDate = $value['referreddate']->format("Y/m/d");
            } else {
                $refDate  = '00/00/0000 00:00:00';
            }

             if(is_in_array($newData, "referreddate", $refDate) == $refDate){
                $result[] = $value;
            }    
        }
    }


?>

