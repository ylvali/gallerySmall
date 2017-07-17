<?php

    //Initiates/adds value to session array
    $nmr[] = 0;
    $this->session->set('nmr', $nmr);

    $nmr = $this->session->get('nmr', []);

    $count = $nmr[0];

    //Controlls if the form has been sent
    $value = isset($_GET['move'])? $_GET['move'] : null;


    //the user can push 'next' or 'previous'
    //this adds the reaction of counting and saving into an array
    $sum = 0;
    if ($value == "next"){
        $sum = $count + 1;

        $nmr[0] = $sum;
        $this->session->set('nmr', $nmr);
    }

    else if ($value == "previous"){
        $sum = $count - 1;

        $nmr[0] = $sum;
        $this->session->set('nmr', $nmr);
    }

    //the count is saved in a variable
    $pictNr = $nmr[0];

    //controll the length of the incoming database array
    $length = sizeOf($img);
    $length = $length - 1;

    //Check so that the count is within the session array spectra
    //If it goes beyond, it is set to 0
    if ($pictNr > $length || $pictNr < 0){
        $pictNr = 0;

        $nmr[0] = 0;
        $this->session->set('nmr', $nmr);
    }
?>



<div class="box3">

    <h1><?=$title?></h1>

    <img src="../<?=$img[$pictNr]?>" alt="image">


    <form  method="get">
        <input type="submit" value="next" name="move">
    </form>

    <form  method="get">
        <input type="submit" value="previous" name="move">
    </form>

</div>
