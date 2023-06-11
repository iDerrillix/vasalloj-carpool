<?php 
    // require 'dbcon.php';
    // $response = array();
    // if(isset($_POST['uID'])){
    //     $uID = $_POST['uID'];
    //     $original_type = $_SESSION['uType'];

    //     $query = "SELECT uType FROM users WHERE uID=$uID";
    //     $result = mysqli_query($con, $query);
    //     if($result){
    //         $row = mysqli_fetch_assoc($result);
    //         if($row['uType'] != $original_type){
    //             $response = array('status' => 'success');
    //         }
    //     } else{
    //         $response = array('status' => 'error');
            
    //     }
    // }
    // $jsonResponse = json_encode($response);
    // header('Content-Type: application/json');
    // echo $jsonResponse;
    require 'dbcon.php';
    $response = array();
    $uID = $_SESSION['uID'];
    $original_type = $_SESSION['uType'];

    $query = "SELECT uType FROM users WHERE uID=$uID";
    $result = mysqli_query($con, $query);
    if($result){
        $row = mysqli_fetch_assoc($result);
        if($row['uType'] != $original_type && $row['uType'] != $_SESSION['uType']){
            $response = array('status' => 'success', 'type' => $_SESSION['uType']);
            $_SESSION['uType'] = $row['uType'];
        } else{
            $response = array('status' => $original_type.' '.$row['uType']);
        }
    } else{
        $response = array('status' => 'error');
    }
    $jsonResponse = json_encode($response);
    header('Content-Type: application/json');
    echo $jsonResponse;
    
?>