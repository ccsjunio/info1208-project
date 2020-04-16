<?php
  session_start();
  // set default timezone for Torongo
  date_default_timezone_set('America/Toronto');
  // loads the class for database connection
  require_once(ROOTFOLDER."/connection/DB.php");
  
  // function to get the movie ratings list
  // acts as a proxy between the page and the
  // database, close to an API
  function getMovieRatings(){
  
    // open the connection creating an instance of the
    // database connection class. if there is a problem
    // then returns null
    if( !$connection = new DB() ) return null;

    // the response will be the return of the method
    $response = $connection->getMovieRatings();

    // destroy the instance of the class
    $connection = null;

    return $response;
  
  } // end of getMovieRatings
  
  // function to insert one movie in the database
  // acts as a proxy between the page and the
  // database, close to an API
  function insertOneMovie( $input_array ){

    // open the connection creating an instance of the
    // database connection class. if there is a problem
    // then returns null
    if( !$connection = new DB() ) return null;

    // the response will the the return of the method.
    // will forward the array containing the movie
    // information
    $response = $connection->insertOneMovie( $input_array );

    // destroy the instance of the class and thus the
    // connection
    $connection = null;

    return $response;

  }

  // returns the markup for the movie ratings list
  function getMovieRatingsReport(){

    // get movie ratings
    // if there is a problem returns an error message
    if( !$movieRatings = getMovieRatings() ) return "Problems with connection to database";
    
    // begins the markup to build a bootstrap style table
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

    // initialize counter for the index in the 
    // movie ratings table in the front end
    $order = 1;
    // iterate throug each movie retrieved from 
    // database to build the rows of the table
    foreach($movieRatings as $movie){

      // build the date markup to exhibit as a human readable date
      // this is the date of creation of the rating, set automatically
      // in the database registry insert
      $dateMarkup = date("F j, Y, g:i a",strtotime($movie['ratingDate']));
      // initialize the movie name as variable
      $movieName = $movie['movieName'];
      // initialize the movie rating as variable
      $movieRating = $movie['movieRating'];
      
      // markup for the row
      $htmlMarkup .= "<!-- begins row for movie $movieName -->";
      $htmlMarkup .= '<div class="row movie-row">';
      $htmlMarkup .= "  <div class='col-1'>#$order</div>";
      $htmlMarkup .= "  <div class='col-5'>$movieName</div>";
      $htmlMarkup .= "  <div class='col-1 text-center'>$movieRating</div>";
      $htmlMarkup .= "  <div class='col-2 text-center'></div>";
      $htmlMarkup .= "  <div class='col-3 text-center'>$dateMarkup</div>";
      $htmlMarkup .= "</div><!-- end of row for $movieName -->";
      
      // increment the index for the next row
      $order++;  

    }

    // close the table
    $htmlMarkup .= "    </div><!-- end of container of the table -->";
    $htmlMarkup .= "  </div><!-- end of main row of records-container -->";

    // return the markup
    return $htmlMarkup;

  } // end of function getMovieRatingsReport()

  // function to reset the submissions counter in the
  // session. Used only on development for testing purposes
  function resetSessionSubmissions(){

    $_SESSION['submissions'] = 0;

    return true;

  }

  function increment_session_count(){

    $_SESSION['submissions'] ++;

    return true;

  }

  function sanitize_string( $input ){

    return filter_var( $input, FILTER_SANITIZE_STRING );

  }

  function sanitize_integer( $input ){

    filter_var( $input, FILTER_SANITIZE_NUMBER_INT );

  }

  // this is a future expansion for other
  // database methods for updating and deleting registries
  
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