<?php 

require_once 'neo4j_file/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;



if(isset($_GET['submit']))
{
  $movie_name =  ($_GET['movie']);
  $client = ClientBuilder::create()->addConnection('default', 'http://neo4j:codeforces21@localhost:7474')->build();
  	$a = "MATCH(m:Movie_new{name:'$movie_name'}) RETURN m.name";
    $b = $client->run($a);

    $tem = $b->getRecords();
    $size = sizeof($tem);
    //echo $size;
    if($size == 0)
    {
        echo "Movie Inserted";
        $query = "CREATE (m:Movie_new { name : '$movie_name' })";
        $result = $client->run($query);
    }
    else
    {
    	echo "Movie already there. Plaese Insert another movie !!!";
    }
}