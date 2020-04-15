<?php
  require_once(ROOTFOLDER."/views/carlos_ferraz_functions.php");

  

  // get post inputs
  $movieEntry = $_POST;
  $inputStatus = array(
    "success"=>false,
    "message"=>""
  );
  
  if(isset($movieEntry['movie-name']) && isset($movieEntry['movie-rating'])){
    
    if(trim($movieEntry['movie-name'])!="" && trim($movieEntry['movie-rating'])!=""){
      
      $movie = array(
        
        "name"    => filter_var( $movieEntry['movie-name'], FILTER_SANITIZE_STRING ),
        "rating"  => filter_var( $movieEntry['movie-rating'], FILTER_SANITIZE_NUMBER_INT )
        
      );

      // input values on database
      $result = insertOneMovie($movie);
      if($result['success']){
        $inputStatus['message'] .= "The movie and rating were inserted with success!";
        $inputStatus['success'] = true;
        // increment number of valid submissions
        if(isset($_SESSION['submissions'])){
          $_SESSION['submissions']++;
        } else {
          $_SESSION['submissions'] = 1;
        }
      }
      
    } else {// if($movieEntry['movie-name']!="" && $movieEntry['movie-rating']!="")
    
      $inputStatus['message'] .= "Both inputs must have a value";
      $inputStatus['success'] = false;
    }

  } else {//  if(isset($movieEntry['movie-name']) && isset($movieEntry['movie-rating']))

    $inputStatus['message'] .= "Both inputs must be sent.";
    $inputStatus['success'] = false;

  }

  // generate input status markup
  $inputStatusMarkup = "";

  if($inputStatus['success']){
    $inputStatusMarkup .= "<div class='alert alert-success' role='alert'>";
  } else {
    $inputStatusMarkup .= "<div class='alert alert-danger' role='alert'>";
  }

  $inputStatusMarkup .= $inputStatus['message'];
  $inputStatusMarkup .= "</div>";
  // end of generation of $inputStatusMarkup

?>

<!doctype html>
<html lang="en">

  <head>
    <?php include_once(ROOTFOLDER.'/templates/page_head.php'); ?> 
    <link rel="stylesheet" href="/style/output.css"/>
  </head>

  <body>

    <header>
      <?php include_once(ROOTFOLDER.'/templates/page_nav.php');?>

      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Movies Rating Results</h1>
          <p class="lead">This are the results so far</p>
        </div>
      </div>
    </header>

    <main>

      <div id="userMessage" class="container">
        <?=$inputStatusMarkup?>
      </div>

      <div class="container">
        <?php echo getMovieRatingsReport(); ?>
      </div>
      <div class="container">
        <a href="/submit" type="button" class="btn btn-primary">Submit another movie</a>
      </div><!-- end of container -->
      
    </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>