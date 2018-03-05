
## Meme Generator - Part 4


### Overview

Using the existing code from parts 1 - 3 edit the `view_memes.html` page so that the thumbs selected from the database will be viewed in the following format:

<img src="http://i.stack.imgur.com/myiVg.jpg" width="400px">

You should use bootstraps (or something similar) so that your thumbnails will display in a grid fashion when page is large, and will collapse into a single stacked column when the screen is reduced in width.

NOT DONE...

### Folder Structure

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