## Files 2 Database - Reading data from a file into a relational database.

## Site Content

Our approach to learning internet programming is a little different. You might think we need to learn some HTML and some Javascript so we can start laying out a site. I say we need a little knowlegde of how the backend works, to include basic linux commands, an intro to our scripting language (PHP) and also an intro to our database Mysql (MariaDB). We have looked at both linux and some PHP (and will continue to expand on both) and now we need to get introduced to our database.

<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/Relational_database_terms.svg/2000px-Relational_database_terms.svg.png" alt="alt text" width="400">

- __Attribute__ =  id, first_name, last_name, email
- __Tuple__ = any one of the rows below
- __Relation__ = the entire collection of rows and attributes (a table)

<img src="https://www.practicalecommerce.com/wp-content/uploads/images/0001/6513/3-redo.jpg" alt="alt text" width="400">

- __key__ = an attribute or set of attributes to identify a subset of attributes in a tuple that is unique.
- __primary_key__ = an attribute or set of attributes that uniquely identifies an entire row (tuple).

In the above example, the `id` could be used as a primary key OR the `email` address since they are unique to each row.
