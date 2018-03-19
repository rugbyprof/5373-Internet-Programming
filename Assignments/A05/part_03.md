## Part 3 - Clean Urls

### Overview

Adding a "clean url" look to our site makes it look much more professional. What do we mean when we say "clean url's"? Examples are the best way to explain:

- Instead of: `https://wtfhw.us/meme_gen2/app.php?route=thumbsdir`
- We use: `https://wtfhw.us/meme_gen2/thumbsdir` to get the same result.

How do we make this happen? We need to install a couple of things on our server, and basically redirect our requests to the proper places.


### Requirements

#### Step 1
- Log into your server. Change to root (if your not already) and install the following apache module:
    - `a2enmod rewrite`
    - Where `a2enmod` is the command to enable a module.
    - And `rewrite` is the module we want to install
- We know have the ability to "rewrite" urls based on pattern matching. 

#### Step 2

- Edit your apache configuration file:
    - `nano /etc/apache2/apache2.conf`
- Scroll down until you see similar code snippets to the one below, and add this snippet to your file.

```
<Directory /var/www/html/meme_gen>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
</Directory>
```

- Now that we edited the config file, we need to restart our apache server:
    - `service apache2 restart`
    - or `/etc/init.d/apache2 restart` 

- We know have the ability to place "rules" in our main site folder to modify (rewrite) our urls.

#### Step 3

- Create a file called: `.htaccess` and add the following code to it:

```
Options +FollowSymLinks
RewriteEngine On

RewriteCond %{SCRIPT_FILENAME} !-d
RewriteCond %{SCRIPT_FILENAME} !-f

RewriteRule ^.*$ ./app.php
```
- Simply put, this will redirect any requests that do not match a filename or a directory name to `app.php`
- So if you type: `https://your.ip.address/meme_gen` you will most likely see a directory dump, because the request matched an existing resource.
- However, if your type `https://your.ip.address/meme_gen/blah` it will redirect you to `https://your.ip.address/meme_gen/app.php` !! Now we can handle getting our routes like I first mentioned at the top.

#### Step 4

This will be a little bit up to you to implement. But I will definitely not leave you haning. Lets start with this snippet:

```php
$request_parts = explode('/', $_SERVER['REQUEST_URI']); 
```

This snippet will turn our request url into an array. For example: `https://your.ip.address/meme_gen/one/two` results in:

```
[
   "",
   "meme_gen",
   "one",
   "two"
]
``` 

You can use this to now replace this in your app when wanting to choose a route:

```php
if(array_key_exists('route',$_GET)){
    $route = $_GET['route'];
}elseif(array_key_exists('route',$_POST)){
    $route = $_POST['route'];
}
```

Instead, your could make sure the route is the first item after the directory name like: `https://your.ip.address/meme_gen/fileUpload`


### Folder Structure

- Added .htaccess folder

```
/var/www/html/meme_generator 
├── .htaccess
├── app.php
├── class_upload.php
├── css
│   ├── style.css
│   ├── bootstrap.min.css
│   └── ...
├── js
│   ├── jquery.min.js
│   ├── simpleUpload.min.js
│   └── ...
├── log.txt
├── settings.php
├── upload.html
├── uploads
│   ├── *.png
│   ├── medium
│   └── thumbs
│       └── *.png
└── view_memes.html
```

### Deliverables

- I can access your site at http://your.ip.address/meme_gen/app.php and will see the output from your api.
- 