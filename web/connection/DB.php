<?php

// class that extends PDO to include the
// methods necessary for this project
class DB extends PDO{
  // declaration of private variables 
  // visible only within this class
  private $host;
  private $dbName;
  private $user;
  private $pass;

  private $statement;

  // construct of function
  public function __construct(){

    // loads the connection parameters
    // to access database
    $this->host = getenv('DB_HOST');
    $this->dbName = getenv('DB_NAME');
    $this->user = getenv('DB_USER');
    $this->pass = getenv('DB_PASS');
    $this->charset = getenv('DB_CHARSET');

    // dsn for mysql connection to database
    $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
    $options = [
      PDO::ATTR_EMULATE_PREPARES    =>  false, // turn off emulation mode for "real prepared statements
      PDO::ATTR_ERRMODE             =>  PDO::ERRMODE_EXCEPTION, // turn on errors in the form of exceptions
      PDO::ATTR_DEFAULT_FETCH_MODE  =>  PDO::FETCH_ASSOC, //make the default fetch be an associate array
      PDO::ATTR_PERSISTENT          =>  true
    ];

    // use the parent construction from original pdo
    parent::__construct($dsn, $this->user, $this->pass, $options);

  } // end of public function construct


  // get all movie ratings from database
  public function getMovieRatings(){

     try{
       
      // state the query to fetch
      // all movie ratings
       $query = <<<EOF
                  SELECT 
                    m.id AS "movieId", 
                    m.sName AS "movieName", 
                    mr.iRating AS "movieRating", 
                    m.tsCreation AS "ratingDate" 
                  FROM tbMovieFromUser m 
                  INNER JOIN tbMovieRating mr ON mr.idMovieFromUser = m.id
                  ORDER BY mr.iRating DESC
EOF;
      
      // prepare the query to be submitted
      $this->statement = $this->prepare($query);
      // execute query
      $this->statement->execute();

      // return an associative array with the results 
      // of the query
      return $this->statement->fetchAll(PDO::FETCH_ASSOC);
      
     } catch (PDOException $e){
      // in case of an error from PDO
      // print error message and return null
      print "Error! : " . $e->getMessage() . "<br/>";
      return null;
     }
  
  } // end of getMovieRatings

  // insert only one movie based on the
  // input array
  public function insertOneMovie($input_array){

    // initialize array for response
    $response = array();
    $response['success'] = false;

    // get movie information from input array
    $movieName = $input_array['name'];
    $movieRating = $input_array['rating'];

    try{

      // insert new movie and get new id
      $this->beginTransaction();
      $this->statement = $this->prepare("INSERT INTO tbMovieFromUser (sName) VALUES (?)");
      $this->statement->execute([$movieName]);
      $newMovieId = $this->lastInsertId();
      $this->commit();

      //insert rating using the id generated
      $this->beginTransaction();
      $this->statement = $this->prepare("INSERT INTO tbMovieRating (idMovieFromUser, iRating) VALUES (?,?)");
      $this->statement->execute([$newMovieId, $movieRating]);
      $newRatingId = $this->lastInsertId();
      $this->commit();

      $response['success'] = true;
    
    } catch (PDOException $e){
      // if there is a problem with the insert
      // roll back and return
      $this->rollBack();
      print "Error! : " . $e->getMessage() . "<br/>";
    
    }

    // return the information of the movie entered
    $response['inputs'] = array(
      "movieName" => $movieName,
      "movieRating" => $movieRating
    );

    return $response;

  } // end of public function insertOneMovie

} // end of class db

?>