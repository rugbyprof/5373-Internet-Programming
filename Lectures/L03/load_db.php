<?php

$db = new mysqli("localhost", "wine_site", "Mm0g4qkrO6mBoiSe", "wine_site");

/* check connection */
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}

$data = json_decode(file_get_contents("winemag-data-130k-v2.json"),true);

// for($i=0;$i<sizeof($data);$i++){
//     print_r($data[$]);
// }

$id = 0;

foreach($data as $row){
    if($id == 0){
        $id++;
        continue;
    }
    
    //print_r($row);
    $sql = "INSERT INTO `wine_reviews` (`id`, `country`, `description`, `designation`, `points`, `price`, `province`, `region_1`, `region_2`, `taster_name`, `taster_twitter_handle`, `title`, `variety`, `winery`) 
        VALUES ('{$id}', '{$row['country']}', '{$row['description']}', '{$row['designation']}', '{$row['points']}', '{$row['price']}', '{$row['province']}', '{$row['region_1']}', '{$row['region_2']}', '{$row['taster_name']}', '{$row['taster_twitter_handle']}', '{$row['title']}', '{$row['variety']}', '{$row['winery']}');";
    
    $result = $db->query($sql);

    $id++;
    if($id%100 == 0){
        echo"Inserted $id rows...\n";
    }
}






