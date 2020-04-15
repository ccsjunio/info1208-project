<?php
  session_start();

  date_default_timezone_set('America/Toronto');
  
  function getConnection(){
    // database connection parameters
    $DB_USER = 'phpuser';
    $DB_PASSWORD = 'phpuser';
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
  

  
  function getMovieRatings(){
  
    
    if(!$connection = getConnection()) return null;

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
      //print "Error! : " . $e->getMessage() . "<br/>";
      return null;
     }
  
  } // end of getMovieRatings
  
  function insertOneMovie($input_array){

    $connection = getConnection();

    if(!$connection) return null;

    $response = array();
    $response['success'] = false;

    $movieName = $input_array['name'];
    $movieRating = $input_array['rating'];

    try{

      // TODO: get all the movies existent and try to find a match

      // insert new movie and get new id
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $connection->beginTransaction();
      $statement = $connection->prepare("INSERT INTO tbMovieFromUser (sName) VALUES (?)");
      $statement->execute([$movieName]);
      $newMovieId = $connection->lastInsertId();
      $connection->commit();

      //insert rating using the id generated
      $connection->beginTransaction();
      $statement = $connection->prepare("INSERT INTO tbMovieRating (idMovieFromUser, iRating) VALUES (?,?)");
      $statement->execute([$newMovieId, $movieRating]);
      $newRatingId = $connection->lastInsertId();
      $connection->commit();

      $response['success'] = true;
    
    } catch (PDOException $e){
      
      $connection->rollBack();
      print "Error! : " . $e->getMessage() . "<br/>";
    
    }


    $response['inputs'] = array(
      "movieName" => $movieName,
      "movieRating" => $movieRating
    );

    return $response;

  }

  function getMovieRatingsReport(){

    // get movie ratings
    
    if(!$movieRatings = getMovieRatings()) return "Problems with connection to database";
    
    $htmlMarkup = "";
    $htmlMarkup .= '<div class="row" id="records-container">';
    $htmlMarkup .= '<!-- container of the table -->';
    $htmlMarkup .= '<div class="col">';
    $htmlMarkup .= '<!-- begins header row -->';
    $htmlMarkup .= '  <div class="row movie-header">';
    $htmlMarkup .= '    <div class="col-1">Order</div>';
    $htmlMarkup .= '    <div class="col-5">Name</div>';
    $htmlMarkup .= '    <div class="col-1 text-center">Rating</div>';
    $htmlMarkup .= '    <div class="col-2 text-center">Cover</div>';
    $htmlMarkup .= '    <div class="col-3 text-center">Data</div>';
    $htmlMarkup .= '  </div><!-- end of header row -->';

    $order = 1;
    foreach($movieRatings as $movie){

      $dateMarkup = date("F j, Y, g:i a",strtotime($movie['ratingDate']));
      $movieName = $movie['movieName'];
      $movieRating = $movie['movieRating'];
            
      $htmlMarkup .= "<!-- begins row for movie $movieName -->";
      $htmlMarkup .= '<div class="row movie-row">';
      $htmlMarkup .= "  <div class='col-1'>#$order</div>";
      $htmlMarkup .= "  <div class='col-5'>$movieName</div>";
      $htmlMarkup .= "  <div class='col-1 text-center'>$movieRating</div>";
      $htmlMarkup .= "  <div class='col-2 text-center'></div>";
      $htmlMarkup .= "  <div class='col-3 text-center'>$dateMarkup</div>";
      $htmlMarkup .= "</div><!-- end of row for $movieName -->";
            
      $order++;  

    }

    $htmlMarkup .= "    </div><!-- end of container of the table -->";
    $htmlMarkup .= "  </div><!-- end of main row of records-container -->";

    return $htmlMarkup;

  }


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