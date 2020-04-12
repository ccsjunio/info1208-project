<?php

  session_start();

  // turn on a debug feature with a query string
  if(isset($_GET['debug'])){
    echo '<pre>';
    var_dump("Session array:", $_SESSION);
    var_dump("Post array:", $_POST);
    echo '</pre>';
  } // end of if(isset($_GET['debug']))

?>