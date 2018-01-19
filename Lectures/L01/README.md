## Day 2 - General intro to php

### Php Variables

- `Integers` − are whole numbers, without a decimal point, like 4195.

- `Doubles` − are floating-point numbers, like 3.14159 or 49.1.

- `Booleans` − have only two possible values either true or false.

- `NULL` − is a special type that only has one value: NULL.

- `Strings` − are sequences of characters, like 'PHP supports string operations.'

- `Arrays` − are named and indexed collections of other values.

- `Objects` − are instances of programmer-defined classes, which can package up both other kinds of values and functions that are specific to the class.

- `Resources` − are special variables that hold references to resources external to PHP (such as database connections).

### Some variable examples:

```php
//Remember var_dump($var);

// Variables start with a $ and are dynamically typed
$a = 34;    //int
$a = 34.34; //now float
$a = "hello world"; //now string
$a = [2,3,4,5,"hello","wow"]; // now array (arrays can hold mixed types)

// Associative array (map)
$a = ['apples'=>34,'bananas'=>454];

// Another associative array
$b = [
    'harddrive'=>4848,
    'cpu'=>8834,
    'monitors'=>2345
];

//Associative arrays can hold other associative arrays
$stuff['fruit'] = $a;
$stuff['computers'] = $b;

//Using empty braces assigns the value to the next available spot like "push"
$stuff[] = [1,2,3];

//This actually works, try it.
$stuff[]++;

var_dump($stuff);
```

### Different ways to open files

___file()___
```php
$path = 'data/winemag-data-130k-v2.csv';
$f = file($path); //reads file into array 1 line per array entry

//foreach loops one iteration per array entry

foreach($f as $row){
    print_r($row);
}
```

___file()___ ___array_map()___ ___array_shift()___ ___array_combine()___
```php
//A better method for reading a csv:
/* Map Rows and Loop Through Them */

//maps a callback function to each row in an arrayremember file() returns an array 
$rows   = array_map('str_getcsv', file($path));   

//array_shift shifts first element off an array.
//this gives us the headers from the csv
$header = array_shift($rows);        

//create an empty array
$csv    = array();

//loop through file and create an "associative array" by using the array_combine function
foreach($rows as $row) {
    $csv[] = array_combine($header, $row);
}
```

___Easiest way___
```php

$fjson = json_decode(file_get_contents('./data/winemag-data-130k-v2.json'),true);

print_r($fjson);

```