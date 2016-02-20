<?php

require_once __DIR__ . '/../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
switch ( true ) {
    case preg_match( '~repos/(.*?)/(.*?)/contributors~', $uri, $matches ):
        echo file_get_contents( __DIR__ . "/responses/repos/{$matches[1]}/{$matches[2]}/contributors/response.json" );
        break;
    case preg_match( '~search/issues\?q=type:pr\+state:closed\+author:(.*?)&per_page=(.*?)&page=(.*)~', $uri, $matches ):
        echo file_get_contents( __DIR__ . "/responses/search/issues/{$matches[1]}/{$matches[3]}/response.json" );
        break;
    default:
        return;
}

@mkdir( __DIR__ . '/requests/' . $uri, 0777, true );
file_put_contents(
    __DIR__ . '/requests/' . $uri . '/request-'.microtime(true).'.serialised',
    serialize( [ 'get' => $_GET, 'post' => $_POST, 'server' => $_SERVER ] )
);