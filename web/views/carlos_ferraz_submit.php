<?php
  require_once(ROOTFOLDER."/views/carlos_ferraz_functions.php");

  // test submissions state
  $submissionsAllowed = true;
  $maxSubmissionsAllowed = 3;

  if(!isset($_SESSION['submissions'])){
    $_SESSION['submissions']=0;
  } else if($_SESSION['submissions']==3) {
    $submissionsAllowed = false;
  }

  // get movie ratings
  $conn = getConnection();
  $movieRatings = getMovieRatings($conn);
  $conn = null;

?>

<!doctype html>
<html lang="en-US">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- favicon -->
    <link rel="icon" href="/img/favicon.ico" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!-- custom style -->
    <link rel="stylesheet" href="/style/main.css"/>

    <title>INFO1208 - PROJECT - CARLOS FERRAZ</title>
  </head>
  <body>
    <header>
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img src="/img/LogoCF.png" width="30" height="30" class="d-inline-block align-top" alt="">
        INFO1208 - Final Project - Carlos Ferraz
      </a>
    </nav>
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
          <div class="alert alert-light" role="alert">
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
          <div class="row" id="records-container">
            <!-- container of the table -->
            <div class="col">
              
            <!-- begins header row -->
              <div class="row movie-header">
                <div class="col-1">Order</div>
                <div class="col-5">Name</div>
                <div class="col-1 text-center">Rating</div>
                <div class="col-2 text-center">Cover</div>
                <div class="col-3 text-center">Data</div>
              </div><!-- end of header row -->

              <?php
              $order = 1;
              foreach($movieRatings as $movie){
                ?>
                <!-- begins row for movie $movie['movieName'] -->
                <div class="row movie-row">
                  <div class="col-1">#<?=$order?></div>
                  <div class="col-5"><?=$movie['movieName']?></div>
                  <div class="col-1 text-center"><?=$movie['movieRating']?></div>
                  <div class="col-2 text-center"></div>
                  <div class="col-3 text-center"><?=date("F j, Y, g:i a",strtotime($movie['ratingDate']))?></div>
                </div><!-- end of row for movie['movieName'] -->
                <?php
                $order++;  
              }
              ?>

            </div><!-- end of container of the table -->
          </div><!-- end of main row of records-container -->
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