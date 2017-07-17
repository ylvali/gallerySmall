<?php
namespace Anax\Gallery;

class GalleryModell implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    
    //this function is going to return what is in the database Gallery

    public function findAll()
    {
                    $this->db->select()
                             ->from('gallery');

                    $this->db->execute();
                    //$this->db->setFetchModeClass(__CLASS__);
                    return $this->db->fetchAll();
    }


    //this function returns one single id

    public function find($id)
    {
                    $this->db->select()
                             ->from('gallery')
                             ->where("id = ?");

                    $this->db->execute([$id]);
                    return $this->db->fetchInto($this);
    }


    //this function will return all of the images

    public function allImages()
    {
                    $this->db->select('img')
                             ->from('gallery');

                    $this->db->execute();
                    return $this->db->fetchAll();
    }
}
