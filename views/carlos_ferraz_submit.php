<?php
  session_start();
  echo "SID: " . session_id();
?>

<!doctype html>
<html lang="en-US">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>INFO1208 - PROJECT - CARLOS FERRAZ</title>
  </head>
  <body>
    <head>
      <h1>We love movies, submit a movie Or view our ratings</h1>
    </head>
    
    <main>
      <button type="button">View all Records</button>
      <!-- container to hold the records container -->
      <div id="records-container">

      </div><!-- end of records container -->
      <form>
        <label>Movie Title<input type="text" placeholder="movie title"/></label>
        <label>Movie Rating
          <select>
            <option value="">Give your movie a rating</option>
            <option value="1">Skip it</option>
            <option value="3">Take it or leave it</option>
            <option value="5">Must see !!</option>
          </select>
        </label>
        <button type="submit">Submit</button>
      </form>    
    </main>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>