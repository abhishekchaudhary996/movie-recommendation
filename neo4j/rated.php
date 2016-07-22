<?php
require_once 'neo4j_file/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;


session_start();
$email = $_SESSION["email"];

$movie_name = ($_GET['movie_name']);

$movie =  ($_GET['id']);


$client = ClientBuilder::create()->addConnection('default', 'http://neo4j:codeforces21@localhost:7474')->build();

if(isset($_GET['submit']))
{
  $rated =  ($_GET['rate']);
  if($rated == "" || $movie_name== "") echo "something missing!!!";
  else
  {
  	echo "data inserted<br>";
  echo "You have rated this movie ".$rated;

 $query = "MATCH (a:People { name: '$email' }), (b:Movie_new { name: '$movie_name' })
          CREATE (a)-[:$rated]->(b)";
 $run = $client->run($query);
  }
  
}


