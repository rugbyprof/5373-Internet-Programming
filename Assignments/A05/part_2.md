
## Meme Generator - Part 1
Due: Friday March 9<sup>th</sup> by Midnight.


### Overview

Using the existing code from http://wtfhw.us/meme_gen_pt1.zip, edit the `view_memes.html` page so that the thumbs selected from the database will be viewed in the following format:

<img src="http://i.stack.imgur.com/myiVg.jpg" width="400px">

You should use bootstraps (or something similar) so that your thumbnails will display in a grid fashion when page is large, and will collapse into a single stacked column when the screen is reduced in width.

### Some Steps to Follow

- Unzip http://wtfhw.us/meme_gen_pt1.zip into your `/var/www/html`
- Make sure the file permissions are correct.  
    - 644 for files
    - 755 for folders
    - 777 for the `uploads` folder and both of the sub directories within it. 
- Change the `settings.php` to reflect your credentials
- Create a database called 

### Remember


### Folder Structure

```
.
├── app.php
├── class_upload.php
├── css
│   └── ...
├── js
│   └── ...
├── log.txt
├── settings.php
├── upload.html
├── uploads
│   ├── medium
│   |     └── ...
│   └── thumbs
│         └── ...
└── view_memes.html
```
