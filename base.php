<?php

function hsc(mixed $string)
{
    return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function csrf_hidden()
{
    return '<input type="hidden" name="csrf_token" value="' . hsc($_SESSION['csrf_token']) . '">' . "\n";
}

function csrf_check()
{
    if (($_POST['csrf_token'] ?? '') !== ($_SESSION['csrf_token'] ?? '')) {
        http_response_code(403);
        exit('Invalid CSRF token');
    }
}

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
