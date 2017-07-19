<?php
/*
*
* This is an Anax pagecontroller
*/

//Include the settings (anax settings)
require __DIR__.'/config.php';

// Create services and inject into the app.
$di  = new \Anax\DI\CDIFactoryDefault();

//You need connection with a database//and then set the database
$di->setShared('db', function () {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/database_sql.php');
    $db->connect();
    return $db;
});

//create the $app
$app = new \Anax\MVC\CApplicationBasic($di);

//Add the gallery controller, inject in $di
$di->set('GalleryController', function () use ($di) {
    $controller = new \Anax\Gallery\GalleryController();
    $controller->setDI($di);
    return $controller;
});


//Setup the database and add some pictures for the gallery

$app->router->add('setupGallery', function () use ($app) {

        $app->db->setVerbose();

       $app->db->dropTableIfExists('gallery')->execute();

       //Create the table in the database:
       $app->db->createTable(
           'gallery',
           [
               'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
               'name' => ['varchar(20)', 'unique', 'not null'],
               'text' => ['varchar(80)'],
               'description' => ['varchar(250)'],
               'img' => ['varchar(255)'],
           ]
       )->execute();

       //Put in some images
       $app->db->insert(
           'gallery',
           ['name', 'text', 'description', 'img']
       );

        $app->db->execute([
            'Wolf',
            'Wolf that runs with wolves',
            'It is a beautiful creature',
            '../img/wolf.jpg'
        ]);


        $app->db->execute([
            'Silvenugget',
            'They call it a silver nugget',
            'Shiny shiny',
            '../img/silverNugget.jpg'
        ]);

        $app->db->execute([
            'Orchide',
            'The coolest flower?',
            'Maybe it is this one',
            '../img/orchide.jpg'
        ]);
});

        //Add the router and connection via dispatch to the gallery
        //Now all functions in the galleryModel will be availible
        $app->router->add('gallery', function () use ($app) {

            $app->dispatcher->forward([
                'controller' => 'gallery',
                'action'     => 'show'
                /*'params'    => [
                    'id' => $id
                ],*/

            ]);

        });

        //Here you should add your own route for displaying the picture gallery in your framework

        //Handle
        $app->router->handle();

        //Render
        $app->theme->render();
