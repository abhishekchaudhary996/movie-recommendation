<?php

require_once 'neo4j_file/vendor/autoload.php';
use GraphAware\Neo4j\Client\ClientBuilder;


session_start();
$email = $_SESSION["email"];


$cosing_simi = "MATCH (p1:Person)-[x:RATED]->(m:Movie)<-[y:RATED]-(p2:Person)
WITH SUM(x.rating * y.rating) AS xyDotProduct,
SQRT(REDUCE(xDot = 0.0, a IN COLLECT(x.rating) | xDot + a^2)) AS xLength,
SQRT(REDUCE(yDot = 0.0, b IN COLLECT(y.rating) | yDot + b^2)) AS yLength,
p1, p2
MERGE (p1)-[s:SIMILARITY]-(p2)
SET s.similarity = xyDotProduct / (xLength * yLength)";
 $run = $client->run($cosing_simi);


 echo "Your Movie recommendation <br>";

 $recom = "MATCH (b:Person)-[r:RATED]->(m:Movie), (b)-[s:SIMILARITY]-(a:Person {name:'$email'})
WHERE NOT((a)-[:RATED]->(m))
WITH m, s.similarity AS similarity, r.rating AS rating
ORDER BY m.name, similarity DESC
WITH m.name AS movie, COLLECT(rating)[0..3] AS ratings
WITH movie, REDUCE(s = 0, i IN ratings | s + i)*1.0 / LENGTH(ratings) AS reco
ORDER BY reco DESC
RETURN movie AS Movie, reco AS Recommendation";

$run = $client->run($recom);

print_r($run);