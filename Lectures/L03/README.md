## Displaying Dynamic Data - The old way ...

The page below is a combination of PHP and HTML, this the old way of creating dynamically loaded data onto a webpage. We will quickly forgo this method of displaying data from a database, but it's a pretty straightforward way of doing it, so we start here.

```php
<?php

print_r($_GET);

if(!array_key_exists('limit',$_GET)){
    $limit = 10;
}

error_reporting(1);
$db = new mysqli("localhost", "wine_site", "Mm0g4qkrO6mBoiSe", "wine_site");

/* check connection */
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}
$limit = 10;
$start = 10;

if(array_key_exists('start',$_GET)){
    $limit = $_GET['start'];
}
?>

<html>

<head>
    <title>Wine Site</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</head>

<body>
    <h1>wine site </h1>
    <div class="container">

    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Taster</th>
      <th scope="col">Twitter Handle</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>


<?php
$sql = "SELECT * FROM wine_reviews LIMIT {$limit} , {$start}";
echo"{$sql}<br>";
$result = $db->query($sql);

$id = $start;
if ($result) {
    // Cycle through results
    while ($row = $result->fetch_assoc()) {
        echo"<tr><th scope=\"row\">{$id}</th><td>{$row['taster_name']}</td><td>{$row['taster_twitter_handle']}</td><td>{$row['price']}</td></tr>";
      $id++;
    }
    // Free result set
    $result->close();
} else{
    echo ($db->error);
}
?>
  </tbody>
</table>
<?php
echo"<a href=>PREV</a> <a href=>NEXT</a> ";
?>
</div>
</body>


</html>
```
