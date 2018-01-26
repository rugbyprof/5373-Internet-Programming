<?php

// Connect to mysql on our local machine
$db = new mysqli("localhost", "wine_site", "***********", "wine_site");

// If connection failed, kill page
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}

// Read in our json file, then turn it into an associative array.
$data = json_decode(file_get_contents("winemag-data-130k-v2.json"),true);

$key = 0; //used as our id or primary_key in the table

//Loop through array, one row per iteration
foreach($data as $row){    
    // Build our query using row data, and sql syntax.
    $sql = "INSERT INTO `wine_reviews` (`id`, `country`, `description`, `designation`, `points`, `price`, `province`, `region_1`, `region_2`, `taster_name`, `taster_twitter_handle`, `title`, `variety`, `winery`) 
        VALUES ('{$key}', '{$row['country']}', '{$row['description']}', '{$row['designation']}', '{$row['points']}', '{$row['price']}', '{$row['province']}', '{$row['region_1']}', '{$row['region_2']}', '{$row['taster_name']}', '{$row['taster_twitter_handle']}', '{$row['title']}', '{$row['variety']}', '{$row['winery']}');";
    
    // the query function performs the query
    // the result var holds information about success or failure of query
    $result = $db->query($sql);

    $key++; // increment our key
    
    //echo confirmation line for 100 rows
    if($id%100 == 0){
        echo"Inserted $id rows...\n";
    }
}






