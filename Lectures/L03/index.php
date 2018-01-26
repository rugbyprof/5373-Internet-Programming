<!doctype html>
<html lang="en">
<?php

// A PHP array that holds all GET vars.
// $_POST holds posted vars (discussed later)
print_r($_GET);


// Get vars are passed like this:
//     http://domain.com/path/to/file?key1=val1&key2=val2&key3=val3
// This results in:
// $_GET['key1'] = val1
// $_GET['key2'] = val2
// $_GET['key3'] = val3

// Turn error reporting on during testing (not production)
error_reporting(1);

$db = new mysqli("localhost", "wine_site", "Mm0g4qkrO6mBoiSe", "wine_site");

// If we have an error connecting to the db, then exit page
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}

// Variables used in our simple pagination scheme

$rowcount = 10; // default number of records to display
$offset = 10; // default starting record number

if (array_key_exists('rowcount', $_GET)) {
    $rowcount = $_GET['rowcount'];
}

if (array_key_exists('offset', $_GET)) {
    $offset = $_GET['offset'];
}

$prev=$offset-$rowcount;  // problems going below zero (handle later)
$next=$offset+$rowcount;  // same going above sizeof the data set

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wine Site</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="images/favicon.png">
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
// With mysql, the LIMIT parameters are offset, rowcount, but the first parameter is optional - crazy, but true!
// So when you have two parameters, the first is the starting row, the second is the number of rows.
$sql = "SELECT * FROM wine_reviews LIMIT {$offset} , {$rowcount}";
echo "{$sql}<br>";
$result = $db->query($sql);

$id = $offset;
if ($result) {
    // Cycle through results
    while ($row = $result->fetch_assoc()) {
        echo "<tr><th scope=\"row\">{$id}</th><td>{$row['taster_name']}</td><td>{$row['taster_twitter_handle']}</td><td>{$row['price']}</td></tr>";
        $id++;
    }
    // Free result set
    $result->close();
} else {
    echo ($db->error);
}
?>
  </tbody>
</table>
<?php
echo "<center><a href={$_SERVER['PHP_SELF']}?offset={$prev}>PREV</a> <a href={$_SERVER['PHP_SELF']}?offset={$next}>NEXT</a></center>";
//print_r($_SERVER);
?>
</div>
</body>


</html>