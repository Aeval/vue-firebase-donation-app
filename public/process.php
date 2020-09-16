<?php
    $conn = new mysqli('localhost', 'root', 'Basch1!!', 'donations_vue_app')
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);
    }

    $result = array('error'=>false);
    $action = '';

    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    if($action == 'read'){
        
        $sql = $conn->query("SELECT * FROM donations");
        $users = array();
        while($row = $sql->fetch_assoc()){
            array_push($users, $row);
        }
        $result['donations'] = $users;
    }

    echo json_encode($result);
?>