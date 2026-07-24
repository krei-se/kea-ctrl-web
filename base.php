<?php

function pr(...$vars)
{
    $output = '';
    foreach ($vars as $var) {
        $output .= print_r($var, true) . "\n";
    }

    if (php_sapi_name() == 'cli')
        echo $output;
    else {
        echo '<pre>';
        echo $output;
        echo '</pre>';
    }
}

function pre(...$vars)
{

    $output = '';
    foreach ($vars as $var) {
        $output .= print_r($var, true) . "\n";
    }

    if (php_sapi_name() == 'cli')
        return $output;
    else {
        return '<pre>' . $output . '</pre>';
    }
}
