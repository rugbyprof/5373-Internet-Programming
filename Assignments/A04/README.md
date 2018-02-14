## Image Scrape - Basic web functionality
Due: Feb 20th by classtime.

### Overview

Use PHP to loop through a json object and save an earthPorn image to a local folder.


### Curl Request

```php
<?php 

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.reddit.com/r/EarthPorn/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_USERAGENT =>'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13',
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 264e0b5d-cd1e-6e0b-2b75-3a2686166b8d"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $data_array = json_decode($response,true);
}

print_r($data_array);
```

### Specifics

- Remember that all the pertinent information is in `$data_array['data']['children']`;
- Loop through that array of image objects using a `foreach` loop.

```php
foreach($data_array['data']['children'] as $image_num => $image_data){

   // do stuff here
}
```

- Remember that `file_get_contents('URL')` will read in a resource (like an image).
- There is a complimentary function called `file_put_contents` that will write a file. 
- Using them together, you can read and save the earthporn images to your local server.
- Save your images to a folder called `earth_images`.


