<?php

require_once 'neo4j_file/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;

if(isset($_GET['submit']))
{
  $email_new =  ($_GET['email']);

  $client = ClientBuilder::create()->addConnection('default', 'http://neo4j:codeforces21@localhost:7474')->build();
/*$a = "MATCH(n:People{name:'a1@gmail.com'}) RETURN n.name";*/
$a = "MATCH(n:People) RETURN n.name";
$b = $client->run($a);

$tem = $b->getRecords();
/*$size = sizeof($tem);
print_r($tem);*/

foreach ($b->getRecords() as $record)
{
    $tem = sprintf('%s', $record->value('n.name'));
    if($tem == $email_new)
    {
    	echo "you are now loged in";
    	session_start();
        $_SESSION["email"] = $email_new;
        //echo $_SESSION["email"];
        echo "<a href='dashboard.php'>Click here to go to dashboard </a>";
        break;
    }
}
}
  