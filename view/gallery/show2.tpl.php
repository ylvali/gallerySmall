<?php

    //get the session
    $nrs = $this->session->get('nrs', []);
    $nrs[] = 0; //add a value of 0

    $pictNr = $nrs[0]; //set the pict nr to first array position

    //Check the incoming img array size
    $length = sizeOf($img);
    $length = $length - 1;

    //when counter exits the image array spectrum (= there is no image)
    //the counter nrs is reset
    if ($pictNr > $length || $pictNr < 0){
        $pictNr = 0;

        $nrs[0] = 0;
        $this->session->set('nrs', $nrs);
    }

    //The form uses $_POST and uses the function form to determine which
    //picture to show next
    //post returns to GalleryController and uses session to keep count.

?>


<div class="box3">

    <h1><?=$title?></h1>

    <img src="../<?=$img[$pictNr]?>" alt="image">

    <form  method="post" action="form">
        <input type="submit" value="next" name="move">
    </form>

    <form  method="post" action="form">
        <input type="submit" value="previous" name="move">
    </form>

</div>
