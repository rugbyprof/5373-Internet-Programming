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

This step places the necessary code in your `app.php` file to handle "clean urls". You will be responsible for the implementation, but I will definitely not leave you hanging. Lets start with this snippet:


First lets get the url that was used to access the page using `$_SERVER['REQUEST_URI']`:

```php
$request_parts = explode('/', $_SERVER['REQUEST_URI']); 
```

The above snippet will turn our request url into an array. For example: `https://your.ip.address/meme_gen/one/two` results in:

```
[
   "",
   "meme_gen",
   "one",
   "two"
]
``` 

You can use that logic in your `app.php` to choose that appropriate route. Here is what we used before:

```php
if(array_key_exists('route',$_GET)){
    $route = $_GET['route'];
}elseif(array_key_exists('route',$_POST)){
    $route = $_POST['route'];
}
```

The above snippet assumed there would be a `GET` or a `POST` variable called `route` with a correct value that the `switch` statement knows about. Instead, your could make sure the route is the first item after the directory name like: `https://your.ip.address/meme_gen/fileUpload` and then use the `$request_parts` array to find the appropriate `route name`.


#### Step 5

- Remember that if you type: `https://your.ip.address/meme_gen` you will most likely see a directory dump (from **step 3**).
- Fix this so that you will not see a directory dump, but the output of `app.php` (list of possible routes).

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

- I can access your site at http://your.ip.address/meme_gen/app.php and will still see the output from your api.
- I can access your site at http://your.ip.address/meme_gen/ and will still see the output from your api.
- I can call appropriate functions using our new "clean url" for example if I call:
    - https://ur.ip.address/meme_gen/thumbsdir 
    - I will see a dump of your thumbnail images (this is already written in the `getThumbsdirect()` function).
