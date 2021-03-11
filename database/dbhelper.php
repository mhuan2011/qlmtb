<?php

    require_once ('config.php');

    function execute($sql){
        $connect = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        //insert, update, delete
        mysqli_query($connect,$sql );

        //close connetion
        mysqli_close($connect);
    }

    function executeResult($sql) {
        $connect = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        



        $result = mysqli_query($connect,$sql );

        $data = [];
        while ($row = mysqli_fetch_array($result, 1)) {
            $data[] = $row;
        }
        //close connetion
        mysqli_close( $connect);
        return $data;
    }

    function executeSingleResult($sql) {
        $connect = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
        
        $result = mysqli_query($connect,$sql );

        $row = mysqli_fetch_array($result, 1);
        //close connetion
        mysqli_close( $connect);
        return $row;
        
    }