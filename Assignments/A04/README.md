## Image Scrape - Basic web functionality
Due: Feb 20th by classtime.

### Overview

Use PHP to loop through a json object and save earthPorn images to a local folder. The curl request below was tested on my laptop at home and should work fine for this purpose.


### Curl Request

```php
<?php 

$curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.reddit.com/r/earthporn/hot.json?limit=100", // Thanks Sam!
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
foreach($data_array['data']['children'] as $key => $image){
    print_r($image['data']['url']);
}
```

- Remember that `file_get_contents('URL')` will read in a resource (like an image).
- There is a complimentary function called `file_put_contents` that will write a file. 
- Using them together, you can read and save the earthporn images to your local server.
- Save your images to a folder called `earth_images`.
- Save the thumbnails to a folder called `earth_thumbnails`.
    - `[thumbnail] => https://thumb.name.jpg`
- The item to save is: 
    - `[url] => https://url.to.image.jpg`.
- The name of the image is: 
    - `[name] => image name`.
- ATTENTION: If the url does not have `.jpg` on the end of it, append it. 
    - `strpos` is a good function to use

