## Displaying Dynamic Data - The old way ...

The page below is a combination of PHP and HTML, this the old way of embedding dynamically loaded data onto a webpage. We will quickly forgo this method of displaying data from a database, but it's a pretty straightforward way of doing it, so we start here.

```php
<?php

// A PHP array that holds all GET vars.
// $_POST holds posted vars (discussed later)
print_r($_GET);

// If "limit" is NOT a GET variable
// make the limit 10;

if(!array_key_exists('limit',$_GET)){
    $limit = 10;
}

// Get vars are passed like this:
//     http://domain.com/path/to/file?key1=val1&key2=val2&key3=val3
// This results in:
// $_GET['key1'] = val1
// $_GET['key2'] = val2
// $_GET['key3'] = val3

// Turn error reporting on during testing (not production)
error_reporting(1);

//Connect to our local mysql database
// "localhost" = "the server your on"  ,      "user name"             "password"              "database name"
$db = new mysqli("localhost",                 "wine_site",            "***********",          "wine_site");


// If we have an error connecting to the db, then exit page
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}

// Variables used in our simple pagination scheme

$limit = 10;    // default number of records to display
$start = 10;    // default starting record number

if(array_key_exists('start',$_GET)){
    $start = $_GET['start'];
}

if(array_key_exists('limit',$_GET)){
    $limit = $_GET['limit'];
}

?>

<html>
<head>
    <title>Wine Site</title>
    
    <!-- Include some styling and javascript libraries to assist us making things look better -->
    <!-- And later, jquery will help make our pages handle events --> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
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
//Get $limit number of rows starting at $start row
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
