<?php
// Turn error reporting on during testing (not production)
error_reporting(1);

require('settings.php');
require('class_upload.php');
require('class_meme.php');



$request_parts = explode('/', $_SERVER['REQUEST_URI']); 

$route = array_pop($request_parts);

$db = new mysqli("localhost", $settings['username'], $settings['password'], $settings['dbname']);
// If we have an error connecting to the db, then exit page
if ($db->connect_errno) {
    print_response(['success'=>false,"error"=>"Connect failed: ".$db->connect_error]);
}

/*
if(array_key_exists('route',$_GET)){
    $route = $_GET['route'];
}elseif(array_key_exists('route',$_POST)){
    $route = $_POST['route'];
}
*/

$routes = ['routes'=>
    [
        ['type'=>'post','name'=>'register','params'=>[]],
        ['type'=>'post','name'=>'login','params'=>['email','']],
        ['type'=>'get','name'=>'thumbsdir','params'=>[]],
        ['type'=>'get','name'=>'thumbsdb','params'=>[]],
        ['type'=>'post','name'=>'fileUpload','params'=>[]],
        ['type'=>'post','name'=>'saveMeme','params'=>[]]
    ]
];

$response = false;

switch($route){
    case 'fileUpload':
         $response = doUpload($settings,$_FILES,'./uploads');
         break;
    case 'thumbsdir':
         $response = getThumbsdirect();
         break;
    case 'thumbsdb':
         $response = getThumbsdb();
         break;
    case 'saveMeme':
        $params = [
            'TopText'=>"I'm sorry Woody....",
            'BotText'=>"Those ARE pictures of your mom.",
            'Font'=>"impact.ttf",
            'FontSize'=>50,
            'FontColor'=>[72, 244, 66],
            'StrokeSize'=>3,
            'StrokeColor'=>[0,0,0],       
            'ImagePath'=>"./",
            'ImageName'=>"toystory_800.png",
            'SavePath'=>"./uploads/saved/",
            'SaveName'=>"toystory_800_saved.png"
        ];
        $m = new Meme($params,0);
        $response = $params;
        break;
    default:
        $urls = [];
        foreach($routes['routes'] as $route){
            $urls[] = ['type'=>$route['type'],'url'=>'https://wtfhw.us'.$_SERVER['PHP_SELF']."?route=".$route['name']];
        }
        $response = $urls;
        $response['request_parts'] = $request_parts;
}

if($response !== false){
    $response['success']=true;
    logg($response);
    print_response($response);
}
////////////////////////////////////////////////////////////////////////


function getThumbsdirect(){
    $path = "uploads/thumbs/";
    $files = scandir($path);
    
    array_shift($files);
    array_shift($files);

    for($i=0;$i<sizeof($files);$i++){
        $files[$i] = $path.$files[$i];
    }
    return $files;
    
}

function getThumbsdb(){
    global $db;
    $files = [];
    $sql = "SELECT thumbPath,imgName,imgType FROM images;";
    $result = $db->query($sql);

    while($row = $result->fetch_array()){
        $files[] = trim($row['thumbPath'].$row['imgName'].'.'.$row['imgType'],"/.");
    }
    
    return $files;
}


function doUpload($settings,$files,$path){
    $uploader = new Upload($settings,$files,$path);
    return $uploader->doUploads();
}


function print_response($response){
    if($response['data']){
        $response['data_size'] = sizeof($response['data']);
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}


