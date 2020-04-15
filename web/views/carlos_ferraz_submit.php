<?php
  require_once(ROOTFOLDER."/views/carlos_ferraz_functions.php");

  // test submissions state
  $submissionsAllowed = true;
  $maxSubmissionsAllowed = 3;

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
        
          <div class="alert alert-danger" role="alert">
            You have aready submitted <?=$maxSubmissionsAllowed?> movies. You cannot submit more than that! Sorry!
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
  </body>
</html>