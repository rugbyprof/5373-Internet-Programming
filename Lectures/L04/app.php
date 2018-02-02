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

// With mysql, the LIMIT parameters are offset, rowcount, but the first parameter is optional - crazy, but true!
// So when you have two parameters, the first is the starting row, the second is the number of rows.

$sql = "SELECT * FROM wine_reviews LIMIT 100";

$result = $db->query($sql);

$html = "";

$id = $offset;
if ($result) {
    // Cycle through results
    while ($row = $result->fetch_assoc()) {
        $html .= "<tr><th scope=\"row\">{$id}</th><td>{$row['taster_name']}</td><td>{$row['taster_twitter_handle']}</td><td>{$row['price']}</td></tr>\n";
        $id++;
    }
    // Free result set
    $result->close();
} else {
    echo ($db->error);
}

echo $html;
