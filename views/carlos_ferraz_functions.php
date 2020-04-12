<?php

  session_start();

  $DB_USER = 'info1208';
  $DB_PASSWORD = 'averybadpassword';
  $DB_HOST = 'localhost';
  $DB_NAME = 'info1208_project';
  $connection = null;

  try{
    $connection = new PDO(
      "mysql:host=$DB_HOST;dbname=$DB_NAME",
      $DB_USER,
      $DB_PASSWORD
    );
  } catch (PDOException $e){
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }

  try{
    foreach($connection->query('SELECT * FROM FOO') as $row){
      print_r($row);
    }
  } catch (PDOException $e){
    print "Error! : " . $e->getMessage() . "<br/>";
  }


?>