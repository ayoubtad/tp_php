<?php

function calculerMoyenne($notes)
{
    if (count($notes) === 0) {
        return 0;
    }

    return round(array_sum($notes) / count($notes), 2);
}
