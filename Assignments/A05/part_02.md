## Part 2 - Alter Files Table

### Overview

- Alter the table in your `memes` database to also store the original filename when a user uploads a file.
- This can be done using phpMyadmin.
- Also, edit the function in `class_upload.php` so that the original filename gets included in the sql insert statement.


### Folder Structure

Nothing changes here ... 

```
/var/www/html/meme_generator 
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

- I can access your site at http://your.ip.address/meme_gen/upload.php and can upload a file.
- I can log in to phpMyadmin and see my file info in the `images` table.
- I can log in to your server and see my file in the appropriate directory.