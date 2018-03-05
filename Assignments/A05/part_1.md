
## Meme Generator - Part 1
Due: Friday March 9th by Midnight.


### Overview

Using the existing code from http://wtfhw.us/meme_gen_pt1.zip, edit the `view_memes.html` page so that the thumbs selected from the database will be viewed in the following format:

<img src="http://i.stack.imgur.com/myiVg.jpg" width="400px">

You should use bootstraps (or something similar)

### Some Steps to Follow

- Unzip in your `/var/www/html`
- Check permissions 
- Change the `settings.php` to reflect your credentials
- 

### Remember


### Folder Structure

- &#128187; var/www/html/meme_gen
    - &#128193; 
        - &#128193; images
        - &#128193; memes
    - &#x21b3; index.html
    - &#128193; css
        - &#x21b3; bootstrap.min.css
        - &#x21b3; some.main.css
    - &#128193; js
        - &#x21b3; bootstrap.min.js
        - &#x21b3; jquery.min.js
    - &#128193; scripts
        - &#x21b3; compare_image.py
        - &#x21b3; meme-api.py
        - &#x21b3; meme-creator.py
        - &#x21b3; seed_db.py

.
├── &#x21b3; app.php
├── &#x21b3; class_upload.php
├── &#128187; css
├── &#128187; js
├── &#x21b3; log.txt
├── &#x21b3; settings.php
├── &#x21b3; upload.html
├── &#128187; uploads
│   ├── &#128187; medium
│   └── &#128187; thumbs
└── &#x21b3; view_memes.html
