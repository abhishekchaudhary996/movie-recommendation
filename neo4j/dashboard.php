<?php

require_once 'neo4j_file/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;


session_start();
$email = $_SESSION["email"];

$client = ClientBuilder::create()->addConnection('default', 'http://neo4j:codeforces21@localhost:7474')->build();
/*$a = "MATCH(n:People{name:'a1@gmail.com'}) RETURN n.name";*/

//print_r($arr);


?>

<!DOCTYPE html>
	<html >
  	<head>
    	<meta charset="UTF-8">
    	<title><?php echo $email ?></title>
    	<link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
  	</head>
  	<body>
  		<div class="container-fluid">
  			<div class="row">
  				<div class="col-md-2 col-md-offset-8" >
  					Welcome <?php $email ?>
  				</div>
  				<div class="col-md-2" >
  					<a href="logout.php"> Logout </a>
  				</div>
  			</div>

  			<div class="row">
  				<h1> <center> Dashboard</center> </h1> (displaying data from neo4j database) </center> 
  			</div>

  			<div class="row">
  				<a href="your_movie_recom.php"> Click here to see your movie recommendation </a>
  			</div>

  			<div class="row">
  				<div class="col-md-6" >
  				<?php

  					$a = "MATCH(n:People) RETURN n.name";
					$b = $client->run($a);
					$tem = $b->getRecords();

					echo "<h3> Total Person </h3> <br>";
					foreach ($b->getRecords() as $record)
					{
    					echo "<a href=''> ".$tem = sprintf('%s', $record->value('n.name'))."</a><br><br>";
    						//$tem = sprintf('%s', $record->value('n.name'));
    						//echo $tem."<br>";
    						//array_push($arr,$tem);
				}?>
  				</div>

  				<div class="col-md-6" >
  				<html>
				<body>

					<form action="put_movie.php" method="get">
						<input type="text" name="movie" placeholder="Insert movie in database">
						<input type="submit" name="submit">
					</form>

				</body>
				</html>

  					<?php
  						$a1 = "MATCH(m:Movie) RETURN m.name";
						$b1 = $client->run($a1);

						$tem1 = $b1->getRecords();
						/*$size = sizeof($tem);
						print_r($tem);*/

						echo "<h3> Total Movie </h3> <br>Click on the movie to give rating<br>";
						foreach ($b1->getRecords() as $record)
						{
							$temp = sprintf('%s', $record->value('m.name'));
    						echo "<a href='rating.php?id=$temp'> ".$tem1 = sprintf('%s', $record->value('m.name'))."</a><br><br>";
						}
  					?>
  				</div>
  			</div>

  		</div>
  	</body>
  	</html>
';
<?php









