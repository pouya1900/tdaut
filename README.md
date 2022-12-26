# Prerequisites

- web server
    - PHP >= 8.0
    - BCMath PHP Extension
    - Ctype PHP Extension
    - cURL PHP Extension
    - DOM PHP Extension
    - Fileinfo PHP Extension
    - JSON PHP Extension
    - Mbstring PHP Extension
    - OpenSSL PHP Extension
    - PCRE PHP Extension
    - PDO PHP Extension
    - Tokenizer PHP Extension
    - XML PHP Extension

# Installation & Configuration

- open your terminal
- go to your domain root directory
- clone repository to your server with :
    - `git clone -b final-ux1 git@github.com:pouya1900/tdaut.git`
- create a file with name .env
    - open file .env.example and copy it to .env
    - find DB_DATABASE , DB_USERNAME and DB_PASSWORD in .env
    - fill it with your database info
        - DB_DATABASE : database name
        - DB_USERNAME : database username
        - DB_PASSWORD : database password
    - find APP_URL and set it with your domain
- install dependency
    - now you can install your dependency with :
        - `composer install`
- create database tables:
    - run this command to create your tables :
        - `php artisan migrate`
- demo data
    - now if you want to import demo data you can use demo.sql file to import manually
    - or use this command :
        - `mysql -u username -p database_name < demo.sql`
            - change `username` to your database username and `database_name` to your database name


- login credentials
    - member :
        - username : example_user@yahoo.com
        - pass : 12345678
    - user :
        - username : example_member@gmail.com
        - pass : 12345678
        
# database

- Entity
    - Administrator
    - capability
    - category
    - degree
    - department
    - document
    - idea
    - inventor
    - media
    - member
    - message
    - office
    - office_permission
    - office_role
    - permission
    - product
    - profile
    - rank
    - report
    - report_type
    - role
    - setting
    - support
    - support_message
    - user


- Relation

# Code

## backend

### classes

- HomeController
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? route
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - index
            - What a function does : show home page
            - What are the function's parameters or arguments are : no parameters
            - What a function returns : view

- OfficeController
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? route
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - index
            - What a function does : show all offices page
            - What are the function's parameters or arguments are : no parameters
            - What a function returns : view
        - show
            - What a function does : show office
            - What are the function's parameters or arguments are : id : the ID of office
            - What a function returns : view
        - members
            - What a function does : show members of office
            - What are the function's parameters or arguments are : id : the ID of office , string type : type of
              members like board,head,... can be null for all members
            - What a function returns : view
        - products
            - What a function does : show products of office
            - What are the function's parameters or arguments are : id : the ID of office , int category : category id
              of products can be null for all categories
            - What a function returns : view

- ProfileController
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? route
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - show
            - What a function does : show user public profile
            - What are the function's parameters or arguments are : id : the ID of member
            - What a function returns : view
        - offices
            - What a function does : show user's offices
            - What are the function's parameters or arguments are : id : the ID of member
            - What a function returns : view

### models

- Administrator
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - profile
            - What a function does : return relation for profile
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : morphOne
        - reports
            - What a function does : return relation for reports
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : hasMany
        - messages
            - What a function does : return relation for messages
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : hasMany

- Capability
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - office
            - What a function does : return relation for office
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsTo

- Category
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - products
            - What a function does : return relation for products
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : hasMany

- Degree
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - members
            - What a function does : return relation for members
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : hasMany

- Department
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - members
            - What a function does : return relation for members
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : hasMany
        - offices
            - What a function does : return relation for offices
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : hasMany

- Document
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - office
            - What a function does : return relation for office
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsTo
        - user
            - What a function does : return relation for user
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsTo

- Idea
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - inventor
            - What a function does : return relation for inventor
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsTo


- Inventor
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - profile
            - What a function does : return relation for profile
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : morphOne
        - ideas
            - What a function does : return relation for ideas
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : hasMany

- Media
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - mediable
            - What a function does : return relation for mediable
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : morphTo

- Member
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - profile
            - What a function does : return relation for profile
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : morphOne
        - degree
            - What a function does : return relation for degree
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsTo
        - department
            - What a function does : return relation for department
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsTo
        - rank
            - What a function does : return relation for rank
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsTo
        - offices
            - What a function does : return relation for offices
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsToMany
        - roles
            - What a function does : return relation for roles
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsToMany

- Message
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - office
            - What a function does : return relation for office
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsTo
        - user
            - What a function does : return relation for user
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsTo

- Office
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - capabilities
            - What a function does : return relation for capabilities
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : hasMany
        - department
            - What a function does : return relation for department
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsTo
        - documents
            - What a function does : return relation for documents
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : hasMany
        - messages
            - What a function does : return relation for messages
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : hasMany
        - members
            - What a function does : return relation for members
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsToMany
        - roles
            - What a function does : return relation for roles
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsToMany
        - products - What a function does : return relation for products - What are the function's parameters or
          arguments are : no parameter - What a function returns : hasMany
        - reports
            - What a function does : return relation for reports
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : morphMany
        - supports
            - What a function does : return relation for supports
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : morphMany
        - media
            - What a function does : return relation for media
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : morphMany
        - getLogoAttribute
            - What a function does : return office logo url
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : string url
        - getSlideshowAttribute
            - What a function does : return office slideshow images url
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : array of string url
        - getCategoriesListAttribute
            - What a function does : return list of office products categories
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : collection
        - scopeActive
            - What a function does : return verified offices
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : eloquent
        - getHeadAttribute
            - What a function does : return head of office
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : member instance

- Office_permission
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - roles
            - What a function does : return relation for roles
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsToMany

- Office_role
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - members
            - What a function does : return relation for members
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsToMany
        - offices
            - What a function does : return relation for offices
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsToMany
        - permissions
            - What a function does : return relation for permissions
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsToMany

- Permission
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - roles
            - What a function does : return relation for roles
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsToMany

- Product
    - Where to obtain instances? <span style="color:yellow">null</span>
    - What are the main methods? <span style="color:yellow">null</span>
    - Is the class abstract? no
    - Who are the main clients of this class? controllers
    - How to use the class? <span style="color:yellow">null</span>
    - function
        - category
            - What a function does : return relation for category
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsTo
        - office
            - What a function does : return relation for office
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : belongsTo
        - reports
            - What a function does : return relation for reports
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : morphMany
        - media
            - What a function does : return relation for media
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : morphMany
        - getLogoAttribute
            - What a function does : return product logo url
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : string url
        - getImagesAttribute
            - What a function does : return product images url
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : array of string url
        - getVideosAttribute
            - What a function does : return product videos url
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : array of string url
        - scopeActive
            - What a function does : return accepted products
            - What are the function's parameters or arguments are : no parameter
            - What a function returns : eloquent





