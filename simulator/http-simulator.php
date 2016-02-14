<?php

require_once __DIR__ . '/../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
switch( true ) {
    case preg_match( '~repos/(.*?)/(.*?)/contributors~', $uri, $matches ):
        echo file_get_contents( __DIR__."/responses/repos/{$matches[1]}/{$matches[2]}/contributors/response.json" );
        break;
}