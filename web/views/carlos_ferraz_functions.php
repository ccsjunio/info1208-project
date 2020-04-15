<?php
  session_start();

  date_default_timezone_set('America/Toronto');

  require_once(ROOTFOLDER."/connection/DB.php");
  
  function getMovieRatings(){
  
    
    if( !$connection = new DB() ) return null;

    $response = $connection->getMovieRatings();

    $connection = null;

    return $response;
  
  } // end of getMovieRatings
  
  function insertOneMovie( $input_array ){

    if( !$connection = new DB() ) return null;

    $response = $connection->insertOneMovie( $input_array );

    $connection = null;

    return $response;

  }

  function getMovieRatingsReport(){

    // get movie ratings

    if( !$movieRatings = getMovieRatings() ) return "Problems with connection to database";
    
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