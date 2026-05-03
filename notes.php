<?php

function calculerMoyenne($notes)
{
    if (count($notes) === 0) {
        return 0;
    }

    return round(array_sum($notes) / count($notes), 2);
}

function determinerMention($moyenne){
    if ($moyenne >= 16) {
        return "Très Bien";
    } elseif ($moyenne >= 14) {
        return "Bien";
    } elseif ($moyenne >= 12) {
        return "Assez Bien";
    } elseif ($moyenne >= 10) {
        return "Passable";
    } else {
        return "Insuffisant";
    }
}
function estAdmis($moyenne, $seuil){
    if ($moyenne >= $seuil){
        return true;
    }else{
        return false;
    }
}