<?php

      
 

//============ db connection

     $database['db_host'] = "localhost";
     $database['db_user'] = "root";
     $database['db_pass'] = "";
     $database['db_dbname'] = "cms";

      foreach($database as $db => $value ){
      	define(strtoupper($db), $value);
      }

      $dbcon = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DBNAME);
      
       if($dbcon == true){
        //echo "Connected...............!!!!";
      }
      else{
      	echo "Connection failed";
      }
      