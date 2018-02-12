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
}elseif(array_key_exists('route',$_POST)){
    $route = $_POST['route'];
}


$routes = ['routes'=>
    [
        ['type'=>'get','name'=>'alltasters','params'=>['taster']],
        ['type'=>'get','name'=>'taster_data','params'=>[]],
        ['type'=>'get','name'=>'scale','params'=>[]],
        ['type'=>'post','name'=>'register','params'=>[]],
        ['type'=>'post','name'=>'login','params'=>['email','']]
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
    case 'register':
         $response = register_user($_POST);
         break;
    case 'login':
         $response = login_user($_POST);
         break;
    default:
        $urls = [];
        foreach($routes['routes'] as $route){
            $urls[] = ['type'=>$route['type'],'url'=>'https://wtfhw.us'.$_SERVER['PHP_SELF']."?route=".$route['name']];
        }
        print_response($urls);
}

if($response){
    $response['success']=true;
    print_response($response);
}
////////////////////////////////////////////////////////////////////////

function login_user($post){
    global $db;

    $em = $post['email'];
    $pass = password_hash(trim($post['password']),PASSWORD_DEFAULT);

    $query = "SELECT * FROM `users` WHERE `email` = '{$em}' AND `password` = '{$pass}'";
    $result = $db->query($query);
    $result = $result->fetch_assoc();
    $response['query'] = $query;
    $response['result'] = $result;
    print_response($response);
}

function register_user($data){
    global $db;
    
    $fn = $data['fname'];
    $ln = $data['lname'];
    $em = $data['email'];
    $pass = password_hash(trim($data['password']),PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO `users` (`email`, `fname`, `lname`, `password`) VALUES ('{$em}', '{$fn}', '{$ln}', '{$pass}')";
    $result = $db->query($sql);
    
    if($result){
        return true;
    }
    
}

function get_taster_data($taster){
    global $db;
    
    $response = [];
    $sql = "SELECT '*' FROM wine_reviews WHERE taster_name LIKE '{$taster}' LIMIT 1000";
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
