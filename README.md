# Projet_2_Mood_in_Music

Here is my 2nd project done after 2 months at Wild Code School with 2 of my classmates.

We used the MVC model under agile method with 4 one-week sprints.

This site is offered to people who love music, we offer a list of royalty-free music, as well as a voting system allowing users (when the vote is launched by an administrator) to make their choice to elect their best music. A ranking page displays user votes in real time.

Feel free to clone to test!

![mood_in_music](https://user-images.githubusercontent.com/76404051/167297560-2e90f41f-06bf-4a78-a2b6-3d7064c31d71.png)



Simple MVC
Description

This repository is a simple PHP MVC structure from scratch.

It uses some cool vendors/libraries such as Twig and Grumphp. For this one, just a simple example where users can choose one of their databases and see tables in it.
Steps

    Clone the repo from Github.
    Run composer install.
    Create config/db.php from config/db.php.dist file and add your DB parameters. Don't delete the .dist file, it must be kept.

define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PASSWORD', 'your_db_password');

    Import database.sql in your SQL server, you can do it manually or use the migration.php script which will import a database.sql file.
    Run the internal PHP webserver with php -S localhost:8000 -t public/. The option -t with public as parameter means your localhost will target the /public folder.
    Go to localhost:8000 with your favorite browser.
    From this starter kit, create your own web application.

Windows Users

If you develop on Windows, you should edit you git configuration to change your end of line rules with this command :

git config --global core.autocrlf true
Example

An example (a basic list of items) is provided (you can load the simple-mvc.sql file in a test database). The accessible URLs are :

    Home page at localhost:8000/
    Items list at localhost:8000/items
    Item details localhost:8000/items/show?id=:id
    Item edit localhost:8000/items/edit?id=:id
    Item add localhost:8000/items/add
    Item deletion localhost:8000/items/delete?id=:id

You can find all these routes declared in the file src/routes.php. This is the very same file where you'll add your own new routes to the application.
How does URL routing work ?

simple_MVC.png
Ask for a tour !

Guided tour

We prepare a little guided tour to start with the simple-MVC.

To take it, you need to install the Code Tour extension for Visual Studio Code : Code Tour

It will give access to a new menu on your IDE where you'll find the different tours about the simple-MVC. Click on play to start one :

menu
Run it on docker

If you don't know what is docker, skip this chapter. ;)

Otherwise, you probably see, this project is ready to use with docker.

To build the image, go into the project directory and in your CLI type:

docker build -t simple-mvc-container .

then, run it to open it on your localhot :

docker run -i -t --name simple-mvc  -p 80:80 simple-mvc-container

