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
      $DB_PASSWORD,
      array(PDO::ATTR_PERSISTENT => true)
    );
    echo "connected";
  } catch (PDOException $e){
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }

  // select records
  try{
    $statement = $connection->prepare("SELECT * FROM FOO");
    $statement->execute();
    foreach($statement as $row){
      print_r($row);
    }
  } catch (PDOException $e){
    print "Error! : " . $e->getMessage() . "<br/>";
  }

  // add record
  try{
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->beginTransaction();
    $statement = $connection->prepare("INSERT INTO FOO (name) VALUES ('test')");
    $statement->execute();
    $connection->commit();
  } catch (PDOException $e){
    $connection->rollBack();
    print "Error! : " . $e->getMessage() . "<br/>";
  }


?>