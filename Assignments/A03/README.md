## Backend - Getting your backend ready to host a site.
## Due - Feb 6<sup>th</sup> by class time.

#### Overview

We have talked about a bunch of stuff and it still feels like 1) we have sooo much more to talk about and 2) we haven't really done anything. Both are true! For this assignment we want to get our database loaded, and create an api that will handle requests from our web page. Soon we will incorporate some bigger better libraries to do this for us, but for now we keep it easy to understand.

#### First

- Make a folder called `wine_site` in your `/var/www/html` folder.
- Everything below goes in that folder.


#### Database

You should have this done already, but if you don't, here is what you do:

- Get the sql file onto your server: [SQL](https://github.com/rugbyprof/5373-Internet-Programming/blob/master/Lectures/L03/wine_site.sql) however you want. I would use the command line `sftp` to `put` the file there, but I'm sure `filezilla` or some other ftp client will do just as well.
- Remember your mysql username and password (your on your own here).
- Load the sql into mysql by doing:
    - `mysql -u yourusername -p databasename < wine_site.sql`
- This file will attempt to create a `database` called `wine_site`, so your user should have permissions to do this OR you log into mysql using the user that owns the `wine_site` `database`.

#### Mysql Credentials

- Create a file called `settings.php` and place this in it:

```php
<?php
$settings = ['username'=>'yourusername',
	     'password' => 'yourpassword',
	     'dbname' => 'wine_site'
];
```

#### API

- Create a file called `app.php` and place the code below in it.
- I cleaned it up from the classroom version, so it's a little nicer. 
- If you browse to `http://your.ip.address/wine_site/app.php` you should see:

```json
[
"https://wtfhw.us/wine_site/app.php?route=alltasters",
"https://wtfhw.us/wine_site/app.php?route=taster_data",
"https://wtfhw.us/wine_site/app.php?route=scale"
]
```


```php
<?php
// Turn error reporting on during testing (not production)
error_reporting(1);

require('settings.php');
$db = new mysqli("localhost", $settings['username'], $settings['password'], $settings['dbname']);
// If we have an error connecting to the db, then exit page
if ($db->connect_errno) {
    print_response(['success'=>false,"error"=>"Connect failed: ".$db->connect_error]);
}

if(array_key_exists('route',$_GET)){
    $route = $_GET['route'];
}

$routes = ['routes'=>
    [
        ['name'=>'alltasters','params'=>['taster']],
        ['name'=>'taster_data','params'=>[]],
        ['name'=>'scale','params'=>[]]
    ]
];

switch($route){
    case 'alltasters' : 
        $response = get_tasters();
        break;
    case 'taster_data':
        if(!array_key_exists('taster',$_GET)){
            print_response(['success'=>false,'error'=>'taster param not present']);
        }
         $response = get_taster_data($_GET['taster']);
        break;
    case 'scale':
         $response = get_taste_scale();
         break;
    default:
        $urls = [];
        foreach($routes['routes'] as $route){
            $urls[] = 'https://wtfhw.us'.$_SERVER['PHP_SELF']."?route=".$route['name'];
        }
        print_response($urls);
}

if($response){
    $response['success']=true;
    print_response($response);
}

function get_taster_data($taster){
    global $db;
    
    $response = [];
    $sql = "SELECT * FROM wine_reviews WHERE taster_name LIKE '{$taster}' LIMIT 1000";
    $response['data'] = [];
    $response['sql'] = $sql;

    $result = $db->query($sql);
    if ($result) {
        // Cycle through results
        while ($row = $result->fetch_assoc()) {
            $response[] = $row;
        }
        // Free result set
        $result->close();
    } else {
        echo ($db->error);
    }
    return $response;
}

function get_tasters(){
    global $db;
    
    $response = [];
    $sql = "SELECT distinct(taster_name) FROM wine_reviews;";
    $response['data'] = [];
    $response['sql'] = $sql;

    $result = $db->query($sql);
    if ($result) {
        // Cycle through results
        while ($row = $result->fetch_assoc()) {
            $response['data'][] = $row;
        }
        // Free result set
        $result->close();
    } else {
        echo ($db->error);
    }
    return $response;
}

function get_taste_scale(){
    return [
        ['scale'=>'95-100','description'=>'Classic: a great wine','min'=>95,'max'=>100],
        ['scale'=>'90-94','description'=>' Outstanding: a wine of superior character and style','min'=>90,'max'=>94],
        ['scale'=>'85-89','description'=>' Very good: a wine with special qualities','min'=>85,'max'=>89],
        ['scale'=>'80-84','description'=>' Good: a solid, well-made wine','min'=>80,'max'=>84],
        ['scale'=>'75-79','description'=>' Mediocre: a drinkable wine that may have minor flaws','min'=>75,'max'=>79],
        ['scale'=>'50-74','description'=>' Not recommended','min'=>50,'max'=>74]
    ];
}

function print_response($response){
    if($response['data']){
        $response['data_size'] = sizeof($response['data']);
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
```

