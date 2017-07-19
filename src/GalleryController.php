<?php
namespace Anax\Gallery;

class GalleryController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;


    //the initialize happens automatically when
    public function initialize()
    {
        $this->gallery = new \Anax\Gallery\Gallery(); //create an object
        $this->gallery->setDI($this->di); //injektar $di i objektet
    }


    //this function is showing all the items in the gallery
    public function showAction()
    {

            $galleryItems = $this->gallery->findAll(); //metoden 'findAll()' hämtar allt i galleriet
            $gItems = "";

            //transfer the objects and their info to presentational piece
        foreach ($galleryItems as $object) {
                $id = $object->id;
                $name = $object->name;
                $text = $object->text;
                //$description = $object->description;
                $image = $object->img;


                $a = "gallery/showId/$id";
                $href = "<a href=$a> See more... </a>";

                $gItems .="<div class='box'>";
                $gItems .= "<h2>$name</h2><hr>";
                $gItems .= "<h3>$text</h3>";
                //$gItems .= "<p>$description</p>";
                $gItems .= "<img src=$image alt=$name>";
                $gItems .= "<br/>";
                $gItems .=$href;
                //$gItems .= "<br/><br/><br/>";
                $gItems .="</div>";
        }


            //Lämnar över till vyn att skriva ut galleriet
            $this->theme->setTitle("The gallery");
            $this->views->add('gallery/test', [
                'items' => $gItems,
                'title' => "The gallery",
                //'image' => $image
            ]);
    }


    //this function will show a single picture
    public function showIdAction($id = null)
    {

            $galleryItem =  $this->gallery->find($id);
            $gItem = "";

        if (!$galleryItem) {

                $gItem = "No such item";

                //Lämnar över till vyn att skriva ut galleriet
                $this->theme->setTitle("The gallery");
                $this->views->add('gallery/test', [
                    'items' => $gItem,
                    'title' => "The gallery",
                ]);

        } else {

                $name = $galleryItem->name;
                $text = $galleryItem->text;
                $description = $galleryItem->description;
                $image = $galleryItem->img;

                //$image = "../$image";
                $image = "../../$image";

                //$gItem .="<div class='box'>";
                //$gItem .= "<h2>$name</h2><hr>";
                $gItem .= "<h3>$text</h3>";
                $gItem .= "<p>$description</p>";
                $gItem .= "<img src=$image alt=$name>";

                //$gItem .="</div>";
                //$gItems .= "<br/><br/><br/>";


                //Lämnar över till vyn att skriva ut galleriet
                $this->theme->setTitle("The gallery");
                $this->views->add('gallery/show1', [
                    'item' => $gItem,
                    'image' => $image,
                    'title' => "$name",
                    'name' => $name
                ]);

        }
    }




    //this function will get all images, it then passes one on to the show

    public function getImagesAction()
    {

        $images =  $this->gallery->allImages(); //getting the images

        //extracting the images from objectmodel
        foreach ($images as $image) {
            $img[] = $image->img;
        }


        $this->theme->setTitle("The gallery");
        $this->views->add('gallery/show2', [
            'title' =>"The image show",
            'img' => $img
        ]);

    }

    //this function collects the form value
    //and saves it to the session memory

    //it is connected to the show view and interplays with it
    //using an array pocket to calculate which the next picture should be

    public function formAction () {

        $action = isset($_POST['move'])? $_POST['move'] : null;

        $nrs = $this->session->get('nrs', []);
        $previous = $nrs[0];
        if ($previous === null) {
                $previous = 0;
            }

        //if the next button was hit = 1
        //if the previous button was hit = 2
        if ($action === "next") {
            $nrs[0] = $previous + 1;
            $this->session->set('nrs', $nrs);
        } else if ($action === "previous") {
            $nrs[0] = $previous - 1;
            $this->session->set('nrs', $nrs);

        } else {
            $nrs[0] = 0;
            $this->session->set('nrs', $nrs);

        }

        header("Location:getImages");

    }
}
