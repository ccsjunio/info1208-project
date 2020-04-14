<?php
  session_start();

  date_default_timezone_set('America/Toronto');
  
  function getConnection(){
    // database connection parameters
    $DB_USER = 'info1208';
    $DB_PASSWORD = 'averybadpassword';
    $DB_HOST = 'db';
    $DB_NAME = 'info1208_project';
    $CHARSET = 'utf8';
    $connection = null;

    // connection string
    $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=$CHARSET";

    // attribute flags for database connection
    $options = [
      PDO::ATTR_EMULATE_PREPARES    =>  false, // turn off emulation mode for "real prepared statements
      PDO::ATTR_ERRMODE             =>  PDO::ERRMODE_EXCEPTION, // turn on errors in the form of exceptions
      PDO::ATTR_DEFAULT_FETCH_MODE  =>  PDO::FETCH_ASSOC, //make the default fetch be an associate array
      PDO::ATTR_PERSISTENT          =>  true
    ];

    // make the connection
    try{
      $connection = new PDO(
          $dsn,
          $DB_USER,
          $DB_PASSWORD,
          $options
      );
      
      return $connection;
      
    } catch (PDOException $e){
      
      print "Error in the connection establishment !: " . $e->getMessage() . "<br/>";
      
      return null;
    
    }
  
  } // end of getConnection
  

  
  function getMovieRatings($connection){
  
    $response = array();
    
     try{
       
       $query = <<<EOF
                  SELECT 
                    m.id AS "movieId", 
                    m.sName AS "movieName", 
                    mr.iRating AS "movieRating", 
                    m.tsCreation AS "ratingDate" 
                  FROM tbMovieFromUser m 
                  INNER JOIN tbMovieRating mr ON mr.idMovieFromUser = m.id
                  ORDER BY mr.iRating DESC
EOF;
      
      $statement = $connection->prepare($query);
      $statement->execute();
      foreach($statement as $row){
        $response[] = $row;
      }

      return $response;
      
     } catch (PDOException $e){
      print "Error! : " . $e->getMessage() . "<br/>";
      return null;
     }
  
  } // end of getMovieRatings
  



  // select records
  /*
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
  */
  // add record
  /*
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
  */

  // delete record
  /*
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
  */
  // update record
  /*
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
  */

?>