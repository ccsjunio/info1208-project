<?php

class DB extends PDO{
  private $host;
  private $dbName;
  private $user;
  private $pass;
  private $charset;

  private $connection;
  private $error;
  private $qError;

  private $statement;

  public function __construct(){

    $this->host = getenv('DB_HOST');
    $this->dbName = getenv('DB_NAME');
    $this->user = getenv('DB_USER');
    $this->pass = getenv('DB_PASS');
    $this->charset = getenv('DB_CHARSET');

    //dsn for mysql
    $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
    $options = [
      PDO::ATTR_EMULATE_PREPARES    =>  false, // turn off emulation mode for "real prepared statements
      PDO::ATTR_ERRMODE             =>  PDO::ERRMODE_EXCEPTION, // turn on errors in the form of exceptions
      PDO::ATTR_DEFAULT_FETCH_MODE  =>  PDO::FETCH_ASSOC, //make the default fetch be an associate array
      PDO::ATTR_PERSISTENT          =>  true
    ];

    parent::__construct($dsn, $this->user, $this->pass, $options);

  } // end of public function construct


  public function getMovieRatings(){

     try{
       
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
      
      
      $this->statement = $this->prepare($query);
      $this->statement->execute();

      return $this->statement->fetchAll(PDO::FETCH_ASSOC);
      
     } catch (PDOException $e){
      print "Error! : " . $e->getMessage() . "<br/>";
      return null;
     }
  
  } // end of getMovieRatings

  public function insertOneMovie($input_array){

    $response = array();
    $response['success'] = false;

    $movieName = $input_array['name'];
    $movieRating = $input_array['rating'];

    try{

      // TODO: get all the movies existent and try to find a match

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
      
      $this->rollBack();
      print "Error! : " . $e->getMessage() . "<br/>";
    
    }


    $response['inputs'] = array(
      "movieName" => $movieName,
      "movieRating" => $movieRating
    );

    return $response;

  } // end of public function insertOneMovie

} // end of class db

?>