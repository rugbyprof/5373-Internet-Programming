## Final Project
### Due: Finals Week

### Candy Store Site

This assignment will encompass everything we have learned up until now with a few additions. We will be constructing a fake online candy store gives users the ability to: 

- Register
- Login
- Search for products
- Add items to shopping cart
- Order Items
- Process credit card

### Part 1

- Group
- Register with Stripe
- Find a theme (preferably boostrap)

### Part 2

- Purchase a domain name: https://www.namecheap.com/
- Point your new domain name to your server: https://www.namecheap.com/support/knowledgebase/article.aspx/9837/46/how-to-connect-a-domain-name-to-a-hosting-account-or-a-server
- Add Secure Socket Layer so we can serve HTTPS pages: https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-16-04

### Part3

So far we have brain stormed on what content and functionality we need to get going. In order to acheive our goal of a somewhat complete ecommerce solution for fake candy, we need to get going on functionality. So we need to start writing some routes to handle events like registration, logging in, searching, etc, but we don't have the necessary DB tables to handle this. 

Routes:

- login (possible help: https://daveismyname.blog/login-and-registration-system-with-php)
- register
- browse with pagination
- search
- categories
- menu items

Milestones:
 
 - Always work on styling and adding little content items to your page to make it seem "real".
     - For example, you can add a contact page with fake contact info, google map link, etc.
     - You can create an "about us" page that is full of rediculously amazing statements about your company.
 - Do not just work on routes and specific things that we discuss in class. You should be working on completing your entire site regardless of what I discuss in class. 
 
 
 - Thursday 26 April:
    - You should be done with a navigation (menu) and categories route.
 - Tuesday May 1:
    - You should have pagination done on the browse candy page.
 - Thursday May 3:
    - Login and registration refresher (we did a simple on early in semester)
    

## Requirements

Below is a list of "user stories" as you might see them from a real client (or software engineering). They go a little like:
>As a < type of user >, I want < some goal > so that < some reason >. I'm getting a little specific with the user stories, so don't tell Dr. Stringfellow that I'm using them wrong!

### Site Client

- **Menu Bar**
   - As a "client", I want "a top menu bar" so that "users can navigate easily".
   - As a "client", I want "a search box in the menu bar" so that "users can search for candy".
   - As a "client", I want "the company title in the menu bar" so that "my site is branded nicely".
   - As a "client", I want "a minum of Home, About Us, Contact, Login and Shopping Cart in the menu bar" so that "Dr. Griffin is happy". (Register can be on the login page).

- **Login / Register**
    - As a "client", I want "users to be able to register and login" so that "users can order candy easily".
    
- **Footer**
   - As a "client", I want "a social media footer menu" so that "users can find us on social media". (links do not have to be real).
   - As a "client", I want "a copy write in the footer" so that "we can protect our site".
   
- **About Page**
    - As a "client", I want "an about page" so that "users know what my company stands for".
    - As a "client", I want "pictures on the about page" so that "users see who our employees are".
    
- **Contact Us Page**
    - As a "client", I want "a contact us page" so that "users know where we are".
    - As a "client", I want "a map on the contact us page" so that "users visually see where we are".
    
- **Shopping Cart**
    - As a "client", I want "a shopping cart" so that "users can actually place orders".
    - As a "client", I want "the shopping cart to remember people" so that "users can have a better experience".
    
- **Stripe**
    - As a "client", I want "to place orders with stripe" so that "I can actually make money".
 
### Shopper
- As a "shopper", I want "to search by keyword" so that "I can find specific candy".
- As a "shopper", I want "to click on categories" so that "I can see all candies in that category".
- As a "shopper", I want "to click on a specific candy" so that "I can see more info about that candy".
- As a "shopper", I want "to be able to add a candy to the shopping cart" so that "I can buy that candy".

### Extra
- As a "shopper", I want "to be able to rate a candy" so that "I can give feedback to other users".



