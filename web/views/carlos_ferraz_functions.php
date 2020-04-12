<?php

  session_start();

  $DB_USER = 'info1208';
  $DB_PASSWORD = 'averybadpassword';
  $DB_HOST = 'localhost';
  $DB_NAME = 'info1208_project';
  $CHARSET = 'utf8';
  $connection = null;

  $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=$CHARSET";

  $options = [
    PDO::ATTR_EMULATE_PREPARES    =>  false, // turn off emulation mode for "real prepared statements
    PDO::ATTR_ERRMODE             =>  PDO::ERRMODE_EXCEPTION, // turn on errors in the form of exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE  =>  PDO::FETCH_ASSOC, //make the default fetch be an associate array
    PDO::ATTR_PERSISTENT          =>  true
  ];

  try{
    $connection = new PDO(
      $dsn,
      $DB_USER,
      $DB_PASSWORD,
      $options
    );
    echo "connected<br/>";
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
      echo "<br/>";
    }
  } catch (PDOException $e){
    print "Error! : " . $e->getMessage() . "<br/>";
  }

  // add record
  try{
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->beginTransaction();
    $statement = $connection->prepare("INSERT INTO FOO (name) VALUES (:name)");
    $statement->bindParam(':name',$name);
    $name = "test";
    $statement->execute();
    $connection->commit();
  } catch (PDOException $e){
    $connection->rollBack();
    print "Error! : " . $e->getMessage() . "<br/>";
  }

  // delete record
  try{
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->beginTransaction();
    $statement = $connection->prepare("DELETE FROM FOO WHERE id=?");
    $id = 1;
    $statement->execute([$id]);
    $connection->commit();
  } catch (PDOException $e){
    $connection->rollBack();
    print "<br/><br/>Error! : " . $e->getMessage() . "<br/>";
  }

  // update record
  try{
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->beginTransaction();
    $statement = $connection->prepare("UPDATE FOO SET name='updated' WHERE id=?");
    $id = 4;
    $statement->execute([$id]);
    $connection->commit();
  } catch (PDOExceoption $e){
    $connection->rollBack();
    print "Error! : " . $e->getMessage() . "<br/>";
  }


?>