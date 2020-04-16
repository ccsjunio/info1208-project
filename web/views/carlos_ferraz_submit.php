<?php
  // test submissions state
  $submissionsAllowed = true;
  $maxSubmissionsAllowed = 3;

  if( isset($_SESSION['submissions']) && isset($resetSubmissions) ){
    $_SESSION['submissions']=0;
    $resetSubmissions = false;
  }

  if(!isset($_SESSION['submissions'])){
    $_SESSION['submissions']=0;
  } else if($_SESSION['submissions']>=3) {
    $submissionsAllowed = false;
  }

?>

<!doctype html>
<html lang="en-US">
  <header>
    <?php include_once(ROOTFOLDER.'/templates/page_head.php'); ?>
  </header>  
  <body>
    <header>
    
    <?php include_once(ROOTFOLDER.'/templates/page_nav.php');?>

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
        
          <div class="alert alert-danger" role="alert" id="maximumSubmissionsReachedAlert">
            You have aready submitted <?=$maxSubmissionsAllowed?> movies. You cannot submit more than that! Sorry!
            <a href="/reset" type="button" class="btn btn-outline-danger" id="btnClearSessionSubmissions">Clear session</a>
          </div>
        
        <?php } ?>

        <?php if($_SESSION['submissions']!=0 && $submissionsAllowed) { ?>
          <div class="alert alert-info" role="alert">
          You have submitted <?=$_SESSION['submissions']?> of the <?=$maxSubmissionsAllowed?> maximum submissions allowed.
          </div>
        <?php } ?>

        <?php if($submissionsAllowed){ ?>
          
          <form class="form-inline" action="/output" method="POST">

            <div class="form-row">

              <label class="sr-only" for="inlineFormInputName2">Movie</label>
              <input type="text" class="form-control mb-2 mr-sm-2" size="50" id="inlineFormInputMovieName" name="movie-name" for="movie-name" placeholder="Movie Title">

              <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Movie Rating</label>
              <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectRating" name="movie-rating" for="movie-rating">
                <option value="">Give your movie a rating</option>
                <option value="1">Skip it</option>
                <option value="2">Take it or leave it</option>
                <option value="3">Must see !!</option>
                <option value="8">I will pay for you to see this !!</option>
              </select>

              <button type="submit" class="btn btn-primary mb-2">Submit</button>

            </div>

          </form>

        <?php } ?>

        <!-- end of form to insert a new movie rating -->

        <button type="button" class="btn btn-primary" id="btnViewAllRecords">View All Records</button>
        <!-- container to hold the records container -->
        <div class="container">
        <?php echo getMovieRatingsReport(); ?>
        </div><!-- end of records-container -->
        
      </div><!-- end of container -->
    </main>
    <?php include_once(ROOTFOLDER."/templates/page_footer.php");?>
  </body>
</html>