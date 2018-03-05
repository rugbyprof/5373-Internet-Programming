## Part 1 - Get It Running

### Overview

- Unzip http://wtfhw.us/meme_gen_pt1.zip into your local `/var/www/html`
- Make sure you create the `memes` database 
- Add a user called `memes` as well
- Edit your settings file to mirror your credentials.
- Message me on slack, sending me my credentials. I should have a username and password to log into the server, and I should have my username placed in the `sudoers` file. Additionally, I need root access to your mysql server. If you simply want to send me your `root` password that will let me log in to both your server and database, that would be fine as well.

```php
$settings = ['username'=>'memes',
	     'password' => 'somenewpassword',
	     'dbname' => 'memes'
];
```
- Create the tables to handle the file uploads:

```sql
CREATE TABLE `images` (
  `id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `imgName` varchar(64) NOT NULL,
  `imgType` varchar(3) NOT NULL,
  `date` int(15) NOT NULL,
  `imgPath` varchar(128) NOT NULL,
  `thumbPath` varchar(128) NOT NULL,
  `tags` text NOT NULL,
  `ipAddress` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `memeText` (
  `id` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `imageID` int(5) NOT NULL,
  `memePath` varchar(128) NOT NULL,
  `topText` varchar(128) NOT NULL,
  `botText` varchar(128) NOT NULL,
  `ipAddress` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `memeText`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `images`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
```

### Folder Structure

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

- I can access your site at http://your.ip.address/meme_gen/app.php and will see the output from your api.