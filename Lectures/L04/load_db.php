<?php

$db = new mysqli("localhost", "wtfhw.us", "kNmwgB3XzWnzprCv", "wtfhw.us");

$data = json_decode(file_get_contents('winemag-data-130k-v2.json'),true);

foreach($data as $row){

$sql = "INSERT INTO `wine_reviews` VALUES  (`{$row['id`, `{$row['country`, `{$row['description`, `{$row['designation`, `{$row['points`, `{$row['price`, `{$row['province`, `{$row['region_1`, `{$row['region_2`, `{$row['taster_name']}`, `{$row['taster_twitter_handle']}`, `{$row['title']}`, `{$row['variety']}`, `{$row['winery']}`)";

$result = $db->query("INSERT INTO table_name VALUES ('one','two','three')");
if ($result) {
    // Cycle through results
    while ($row = $result->fetch_assoc()) {
        $user_arr[] = $row;
    }
    // Free result set
    $result->close();
}else{
    echo ($db->error);
}
}
