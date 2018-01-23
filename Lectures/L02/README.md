## Files 2 Database - Reading data from a file into a relational database.

## Site Content

Our approach to learning internet programming is a little different. You might think we need to learn some HTML and some Javascript so we can start laying out a site. I say we need a little knowlegde of how the backend works, to include basic linux commands, an intro to our scripting language (PHP) and also an intro to our database Mysql (MariaDB). We have looked at both linux and some PHP (and will continue to expand on both) and now we need to get introduced to our database.

<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/Relational_database_terms.svg/2000px-Relational_database_terms.svg.png" alt="alt text" width="400">

- __Attribute__ =  id, first_name, last_name, email
- __Tuple__ = any one of the rows below
- __Relation__ = the entire collection of rows and attributes (a table)

<img src="https://www.practicalecommerce.com/wp-content/uploads/images/0001/6513/3-redo.jpg" alt="alt text" width="400">

- __key__ = an attribute or set of attributes to identify a subset of attributes in a tuple that is unique.
- __primary_key__ = an attribute or set of attributes that uniquely identifies an entire row (tuple).

In the above example, the `id` could be used as a primary key OR the `email` address since they are unique to each row. Even though the names are all unique, we don't use those as primary keys since there can be two individuals with the same name. 

#### More To Come 

I will add more above and below....

## Connecting To Mysql Via Php

<sub>Source: http://php.net/manual/en/mysqli.query.php </sub>
```php
<?php
$db = new mysqli("localhost", "my_user", "my_password", "world");

/* check connection */
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}

/* Create table doesn't return a resultset */
if ($db->query("CREATE TEMPORARY TABLE myCity LIKE City") === TRUE) {
    printf("Table myCity successfully created.\n");
}

/* Select queries return a resultset */
if ($result = $db->query("SELECT Name FROM City LIMIT 10")) {
    printf("Select returned %d rows.\n", $result->num_rows);
    
    /* free result set */
    $result->close();
}


// 1st Query
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

// 2nd Query
$result = $db->query("SELECT * FROM some_table");
if ($result) {
    // Cycle through results
    while ($row = $result->fetch_assoc()) {
        $group_arr[] = $row;
    }
    // Free result set
    $result->close();
} else
    echo ($db->error);
}

// Close connection
$db->close();
?>
```

https://www.digitalocean.com/community/tutorials/how-to-add-swap-space-on-ubuntu-16-04
