<?php 

require_once 'neo4j_file/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;



if(isset($_GET['submit']))
{
  $first_name =  ($_GET['f1-first-name']);
  $last_name =  ($_GET['f1-last-name']);
  $about =  ($_GET['f1-about-yourself']);

  //echo $first_name." ".$last_name." ".$about;

  $email = ($_GET['f1-email']);
  $password = ($_GET['f1-password']);
  $re_password = ($_GET['f1-repeat-password']);

  //echo $email." ".$password." ".$repassword;

  $fb = ($_GET['f1-facebook']);
  $twitter = ($_GET['f1-twitter']);
  $google = ($_GET['f1-google-plus']);

  ///echo $fb." ".$twitter." ".$google;

  if($password != $re_password || $password == "" || $re_password == "")
  {
  	$error = "Invalid Login";
  	echo $error.'<br>';
  	echo "Redirecting to home page ...";
  	
  	echo "<meta http-equiv='refresh' content='3;URL=index.html' />";
  }
  else
  {
  	$client = ClientBuilder::create()->addConnection('default', 'http://neo4j:codeforces21@localhost:7474')->build();
  	$a = "MATCH(n:People{name:'$email'}) RETURN n.name";
    $b = $client->run($a);

    $tem = $b->getRecords();
    $size = sizeof($tem);
    //echo $size;
    if($size == 0)
    {
        echo "New Node Created";
        $query = "CREATE (n:People { name : '$email' })";
        $result = $client->run($query);
        echo "<a href='login.html'> Click here to login </a>";
    }
    else
    {
    	echo "You are already register with us !!!";
    	echo "<a href='login.html'> Click here to login </a>";
    }
  }
}
  