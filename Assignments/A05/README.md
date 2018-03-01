
## Meme Generator

- ***Part 1 Due: ??***
- ***Part 2 Due: ??***
- ***Part 3 Due: ??***

### Overview

Using the existing code from here

### Remember


### Folder Structure

- &#128187; var/www/html/meme_generator 
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

### Part 1
Due: 10 Oct By Class time.

***Meme Route***

Add a oute in `app.php` to create the text for a meme. Your route will receive posted data similar to the following and 
will insert it into the existing table we created. Make any changes to the table to make this work.

```json
{
	"top_text" : "You smell good",
	"bot_text" : "when your sleeping...",
	"style_info" : {
		"text-color" : [
			0,
			0,
			0
		],
		"text-size" : 24,
        	"font" : "Ultra-Regular.ttf"
	},
}
```



We will discuss this a little more in class. However, most of the code is written for you, you simply need to 
refactor it. You don't need to connect this to our front end right now, you simply need to use "postman" or something similar to test your method is working. 

### Part 1 Deliverables

- On your server create a folder called `meme_gen_1`
- I should be able to run postman and hit your meme route to create a new "document" representing the meme.


### Part 2

### Part 2 Deliverables



### Part 3

