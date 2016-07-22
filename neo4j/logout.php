<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
session_unset();
session_destroy();
?>
<html>
    <head>
      <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/findfriends.css">
    </head>
    <body>
      <div class="container-fluid" id ="wait">
        <div class="row">
          <div class="col-md-2 col-md-offset-5">
            <img src="img/500.gif"> </img>
          </div>
        <div class="row">
          <div class="col-md-4 col-md-offset-4">

<?php

echo "You are now logout ";
echo "You are now redirect to home page...";
echo "<meta http-equiv='refresh' content='2;URL=index.html' />";
echo "</div> </div> </body></html>";
?>

</body>
</html>