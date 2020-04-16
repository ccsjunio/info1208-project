<?php
  // get post inputs
  $movieEntry = $_POST;
  // empty the post array to avoid resubmission of data in case the 
  // page is refreshed. This approach is taken when the javascript
  // one does not working for being disabled
  $_POST = array();
  // initialize the input status array
  // that indicates the analysis about the
  // data posted to the page, if any
  $inputStatus = array(
    "success"=>false,
    "message"=>""
  );
  
  // tests if both posts for name and rating were inserted
  if(isset($movieEntry['movie-name']) && isset($movieEntry['movie-rating'])){
    
    // tests if both movie name and movie rating are not empty
    // first trim the spaces so that an input with only spaces cannot pass
    // the movie rating can be an empty string if there is no selection
    if(trim($movieEntry['movie-name'])!="" && trim($movieEntry['movie-rating'])!=""){
      
      // build the movie information array
      $movie = array(
        
        // sanitize the information entered for name and rating
        // avoid sql injections and other malicious code to be entered
        // also the pdo abstraction layer and preparation of queries will
        // contribute to avoid any damage in the database, or exposure of data
        "name"    => filter_var( $movieEntry['movie-name'], FILTER_SANITIZE_STRING ),
        "rating"  => filter_var( $movieEntry['movie-rating'], FILTER_SANITIZE_NUMBER_INT )
        
      );

      // input values on database calling the proxy function
      // to insert the movie in the database
      $result = insertOneMovie($movie);
      
      // if the result of the input is successful, update the
      // inputstatus array
      if($result['success']){
        $inputStatus['message'] .= "The movie and rating were inserted with success!";
        $inputStatus['success'] = true;
        
        // increment number of valid submissions
        // if for some reason the submissions attribute
        // of session is not set, set it for one
        if(isset($_SESSION['submissions'])){
          $_SESSION['submissions']++;
        } else {
          $_SESSION['submissions'] = 1;
        }
      }
      
    } else {// if($movieEntry['movie-name']!="" && $movieEntry['movie-rating']!="")
    
      // if both or one of inputs are empty strings then do not
      // insert and throw an error message
      $inputStatus['message'] .= "Both inputs must have a value";
      $inputStatus['success'] = false;
    }

  } else {//  if(isset($movieEntry['movie-name']) && isset($movieEntry['movie-rating']))

    // if one or all inputs were not sent than throw an error message
    $inputStatus['message'] .= "Both inputs must be sent.";
    $inputStatus['success'] = false;

  }

  // generate input status markup
  // to indicate to the user the result
  // of the inputs entered (or not entered)
  // will diferentiate the type of alert color
  // depending on the results of the inputs
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

  <!-- loads the page head from a template, to normalize the heading of every page -->
  <!-- and reflects changes to all of them without much work load -->
  <head>
    <?php include_once(ROOTFOLDER.'/templates/page_head.php'); ?> 
    <link rel="stylesheet" href="/style/output.css"/>
  </head>

  <body>

    <header>
      <!-- insert the navigation bar on the top of the page -->
      <!-- allows it to be the same all over the pages -->
      <?php include_once(ROOTFOLDER.'/templates/page_nav.php');?>

      <!-- introductory banner on the page -->
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Movies Rating Results</h1>
          <p class="lead">These are the results so far</p>
        </div>
      </div>
    </header>

    <main>
      <!-- container of the message for the user indicating -->
      <!-- the results of the inputs processing -->
      <div id="userMessage" class="container">
        <?=$inputStatusMarkup?>
      </div>

      <!-- container to hold the movie ratings list -->
      <!-- obtained through the function and injected in the php -->
      <div class="container">
        <?php echo getMovieRatingsReport(); ?>
      </div>

      <!-- container to hold the button to jump to the -->
      <!-- movie rating submission page -->
      <div class="container">
        <a href="/submit" type="button" class="btn btn-primary">Submit another movie</a>
      </div><!-- end of container -->
      
    </main>
    <!-- loads the footer with javascripts for the pages -->
    <?php include_once(ROOTFOLDER."/templates/page_footer.php");?>
  </body>
</html>