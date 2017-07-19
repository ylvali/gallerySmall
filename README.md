
This package needs to be installed with the Anax-phpmvc
There needs to be a working environment .

In gallery.php in the webroot there is an example of a frontcontroller.
Add the display route in your framework and this picture gallery is ready to use,
just make sure it is wired properly.

Then it should work nicely.

It is a simple gallery, when clicking on an image you get to see the big version of the picture.

There is also the code for flipping through a series of images.

It is a modell - controller based module , each picture in the gallery becomes an object.
The pictures are collected from a list in your database.

You need to have a connection to a database and this album is working from the table 'gallery' in the code right now.

Oh, and dont forget to style the box div :)

The dependency is CDatabase by Mos, Mikael Roos.
Available at packagist.

This whole anax phpmvc system is built by Mikael Roos,
this task was a part of his course in the Swedish university 2017.

I chose to make a gallery that is the base for making a product display online.
If you have cool ideas, contact me.

//Ylva
ylva@spektatum.com
www.ylvadesign.com
