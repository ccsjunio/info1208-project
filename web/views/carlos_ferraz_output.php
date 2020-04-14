<?php
  require_once(ROOTFOLDER."/views/carlos_ferraz_functions.php");

  

  // get post inputs
  $movieEntry = $_POST;
  $inputStatusMessage = "";
  
  if(isset($movieEntry['movie-name']) && isset($movieEntry['movie-rating'])){
    
    if(trim($movieEntry['movie-name'])!="" && trim($movieEntry['movie-rating'])!=""){
      
      $movie = array(
        
        "name"    => filter_var( $movieEntry['movie-name'], FILTER_SANITIZE_STRING ),
        "rating"  => filter_var( $movieEntry['movie-rating'], FILTER_SANITIZE_NUMBER_INT )
        
      );

      // input values on database
      $connection = getConnection();
      $result = insertOneMovie($connection, $movie);
      if($result['success']){
        $inputStatusMessage .= "The movie and rating were inserted with success!";
        // increment number of valid submissions
        if(isset($_SESSION['submissions'])){
          $_SESSION['submissions']++;
        } else {
          $_SESSION['submissions'] = 1;
        }
      }
      
    } else {// if($movieEntry['movie-name']!="" && $movieEntry['movie-rating']!="")
    
      $inputStatusMessage .= "Both inputs must have a value";
    
    }

  } else {//  if(isset($movieEntry['movie-name']) && isset($movieEntry['movie-rating']))

    $inputStatusMessage .= "Both inputs must be sent.";

  }


  // get movie ratings
  $connection = getConnection();
  $movieRatings = getMovieRatings($connection);
  $connection = null;

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <head></head>

    <main>

      <div id="userMessage">
        <?=$inputStatusMessage?>
      </div>

      <div id="results">
      <div id="records-container">
        <table border="1">
          <tr>
            <th>#Order</th>
            <th>Name</th>
            <th>Rating</th>
            <th>Cover</th>
            <th>Date</th>
          </tr>
          <?php
            $order = 1;
            foreach($movieRatings as $movie){
              ?>
              <tr>
                <td>#<?=$order?></td>
                <td><?=$movie['movieName']?></td>
                <td><?=$movie['movieRating']?></td>
                <td></td>
                <td><?=date("F j, Y, g:i a",strtotime($movie['ratingDate']))?></td>
              </tr>
              <?php  
              $order++;
            }
          ?>
        </table>
      </div>

      <button type="button"><a href="/submit">Submit another movie</a></button>

    </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>