# PHP Model View Controller Framework
Simple PHP Framework to build and develop websites by easy and efficient ways.

## Introduction

It is a small PHP framework, the main goal of it is helping the developer to build his web project in Model View Controller Architecture pattern, it provides him more functionalities to support the basics core of this pattern and some utilities and features makes the web sites developing more easy.

## The reason of implementing the framework

I’m implemented this framework for my personal practicing on the design or architecture patterns concepts, specially the MVC pattern and trying to implement some features and utilities of the big MVC frameworks like **Laravel** to have a right and big understanding of how each functionality work in the low level.

## Prerequisites
Just install Apache server on your machine and turn on it.

## Getting Start 

You can staring to use the framework by a few steps :
- Download the repository.
- Move the file to **htdocs** file that in your local server.
- Change the file name with your project name.
- start building and developing your worbsite.

## Directory Structure

- **_application_**
  - **_config_**
    - **_config.php_** 
        > **This file contains all data that needed to connect the project database
        so, you can open and edit this data to connect your database.**
     - **_init.php_**
        > **This file contains some global constant values you can access it in any file of your project
        and if you want to define other global constants you should create it in this file.**
     - **_routes.php_**
       > **This file contains all defined routes of your project and this file now empty
       so, if you want to create a default route you should create it in this file.**
  - **_controllers_**
    > **You should create all controllers classes files in this directory and
    each file name should be the same name of the class name that is inside this file and
    each controller should have word "Controller" after his name and the same in his file name (e.g: homeController.php).**
  - **_models_**
    > **You should create all models classes files in this directory and
    each file name should be the same name of the class name that is inside this file and
    each model should have word "Model" after his name and the same in his file name (e.g: homeModel.php).**
  - **_views_**
    >**You should create all your views in this directory and to create view,
    should first create a dirctory and its name is the name of this view
    and create index.php file inside this dirctory having your view implementation.**
    - **_home_**
      > **This is the default view and an example how to create view.**
      - **_index.php_**
    - **_Layouts_**
      > **If you want to create a templates to extend it in your views souch as a default layouts, you should create this file in this dirctory.**
- **_framework_**
  - **_core_**
    > **This dirctory contains all core classes files that manage the request life cycle depends on the Model View Controller architecture Pattern.**
    
    - **_controller.php_**
    - **_framework.php_**
    - **_model.php_**
    - **_router.php_**
    - **_view.php_**
  - **_database_**
    > **This dirctory contains the database class that create all database connections.**
     - **_database.php_**
   - **_liberaries_**
     - **_session.php_**
     - **_cookies.php_**
- **_public_**
  > **The public directory contains the index.php file, which is the entry point for all requests entering your application, its having the decraration of the framework class and few implementation to start this life cycle.**
  - **_index.php_**

## Routing
You have to ways to route your request to the valid controller to start its life cycle
### **_Basic routing:-_**
By the basic routing way, you can create/ set any number of routes manualy.
The first you should create this routes in the file **_routes.php_** 
The full path of the file is :-
> **application/config/routes.php**
#### How to create the route?
You can use the **static** function of the **router** class that called **setPath** and the function takes two or three parameters:-
1. **URL** (required):- the request that you want to route it.
2. **Controller** (required):-the name of controller that you want run it when this URL required and should have word "Controller" after the controller name.
3. **Function** (optional) :- the name of controller's function that you want run it when this URL requested and the default of this parameter is **index** function.
```php
    router::setPath("/" , "homeController"); // in this case the function name is "index"
    router::setPath("/about" , "aboutStartUpController" , "allDetails");
```
**Note : if you want to send arguments to the controller's function you can sent it by GET/ POST Methodes and access this values bb the global varibles $\_POST/ $\_GET in php**

I'm working to make the URL having a variables and send it to the controller's function.
### **_fixed/ automatic routing:-_**
