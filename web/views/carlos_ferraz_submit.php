<?php
  // define state of allowability of submission
  $submissionsAllowed = true;
  // define the maximum submissions allowed
  define("MAX_SUBMISSIONS_ALLOWED", 3);

  // if the submissions attribute from session is defined
  // and it is set the resetSubmissions flag
  // the submissions counter is reset to zero
  // this is used only in development and this parameter
  // is called upon the pressing of the button "reset"
  if( isset($_SESSION['submissions']) && isset($resetSubmissions) ){
    $_SESSION['submissions']=0;
    // detrsoy the variable so that a reload cannot reset it again
    unset($resetSubmissions);
  }

  // if the submissions counter in the session is not set
  // then set it to zero submissions
  if(!isset($_SESSION['submissions'])){
    $_SESSION['submissions']=0;
  } else if($_SESSION['submissions']>=MAX_SUBMISSIONS_ALLOWED) {
    // if it is set and already 3 submissions were
    // made than the flag of submissions allowed is set
    // to false, hiding the submission form
    // the test of greater than 3 in the case some submission
    // is made through an automated resend of the form
    $submissionsAllowed = false;
  }

?>

<!doctype html>
<html lang="en-US">
  <header>
    <!-- include the head template for pages in this application -->
    <?php include_once(ROOTFOLDER.'/templates/page_head.php'); ?>
  </header>  
  <body>
    <header>
    <!-- include the navigation bar standard for the pages in this application -->    
    <?php include_once(ROOTFOLDER.'/templates/page_nav.php');?>

    <!-- main banner of the page, indicating its function -->
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Movies Rating</h1>
        <p class="lead">We love movies, submit a movie Or view our ratings</p>
      </div>
    </div>
    </header>
    
    <main>
      <div class="container">

        <!-- form to insert a new movie rating -->
        <?php if(!$submissionsAllowed) { ?>
        
          <!-- if the maximum number of submissions is reached, tested by the flag -->
          <!-- maxSubmissionsAllowed, than this alert message appears for the user -->
          <div class="alert alert-danger" role="alert" id="maximumSubmissionsReachedAlert">
            You have aready submitted <?=MAX_SUBMISSIONS_ALLOWED?> movies. You cannot submit more than that! Sorry!
            <a href="./reset" type="button" class="btn btn-outline-danger" id="btnClearSessionSubmissions">Clear session</a>
          </div>
        
        <?php } ?>
        
        <!-- if the maximum submissions were not reached, and the submissions are more than zero -->
        <!-- display a message indicating how many submissions were made from the maximum number allowed -->
        <?php if($_SESSION['submissions']!=0 && $submissionsAllowed) { ?>
          <div class="alert alert-info" role="alert">
          You have submitted <?=$_SESSION['submissions']?> of the <?=MAX_SUBMISSIONS_ALLOWED?> maximum submissions allowed.
          </div>
        <?php } ?>

        <!-- if submissions are allowed, aka the maximum number is not achieved -->
        <!-- show the submission form for a new movie rating -->
        <?php if($submissionsAllowed){ ?>
          
          <!-- declaration of the submission form submiting to the output page -->
          <!-- through the router -->
          <form class="form-inline" action="./output" method="POST">

            <div class="form-row">

              <!-- input for the name of the movie, encapsulated by a label -->
              <label class="sr-only" for="inlineFormInputName2">Movie</label>
              <input type="text" class="form-control mb-2 mr-sm-2" size="50" id="inlineFormInputMovieName" name="movie-name" for="movie-name" placeholder="Movie Title">
              <!-- select for the rating of the movie, encapsulated by a label -->
              <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Movie Rating</label>
              <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectRating" name="movie-rating" for="movie-rating">
                <option value="">Give your movie a rating</option>
                <option value="1">Skip it</option>
                <option value="2">Take it or leave it</option>
                <option value="3">Must see !!</option>
                <option value="8">I will pay for you to see this !!</option>
              </select>
              <!-- submit button of the form -->
              <button type="submit" class="btn btn-primary mb-2">Submit</button>

            </div>

          </form>

        <?php } ?>

        <!-- end of form to insert a new movie rating -->
        
        <!-- button to be clicked to toggle the visibility of the list of movie ratings -->
        <button type="button" class="btn btn-primary" id="btnViewAllRecords">View All Records</button>
        <!-- container to hold the records container -->
        <!-- calls the function to build the markup for the list of movie ratings -->
        <!-- as the list of movies is used on other page, the markup is produced by -->
        <!-- so that can be reproduced at a larger scale -->
        <div class="container">
        <?php echo getMovieRatingsReport(); ?>
        </div><!-- end of records-container -->
        
      </div><!-- end of container -->
    </main>
    <!-- template footer for the pages of this application -->
    <?php include_once(ROOTFOLDER."/templates/page_footer.php");?>
  </body>
</html>