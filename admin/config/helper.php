<?php

// Function debug
function dd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die;
}
