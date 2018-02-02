<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="google" content="notranslate">
    <meta http-equiv="Content-Language" content="en">
    <title>Wine Site</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="images/favicon.png">
    <!-- Include some styling and javascript libraries to assist us making things look better -->
    <!-- And later, jquery will help make our pages handle events -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    
</head>
<body>
<?php
// Get vars are passed like this:
//     http://domain.com/path/to/file?key1=val1&key2=val2&key3=val3
// This results in:
// $_GET['key1'] = val1
// $_GET['key2'] = val2
// $_GET['key3'] = val3

// Turn error reporting on during testing (not production)
error_reporting(1);

require('settings.php');
$db = new mysqli("localhost", $settings['username'], $settings['password'], $settings['dbname']);
// If we have an error connecting to the db, then exit page
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}

?>
    <h1>wine site </h1>
    <div class="container">
    <table id="example" class="table table-striped display" cellspacing="0" width="100%">
    <thead>
       <tr>
          <th scope="col">#</th>
          <th scope="col">Taster</th>
          <th scope="col">Twitter Handle</th>
          <th scope="col"> Price </th>
       </tr>
   </thead>
   <tbody>
<?php
// With mysql, the LIMIT parameters are offset, rowcount, but the first parameter is optional - crazy, but true!
// So when you have two parameters, the first is the starting row, the second is the number of rows.

$sql = "SELECT * FROM wine_reviews";

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
</div>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
</body>
</html>

