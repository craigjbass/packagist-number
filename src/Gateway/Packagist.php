<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 20/02/2016
 * Time: 15:55
 */

namespace Craigjbass\PackagistNumber\Gateway;


class Packagist implements PackageManagerStore
{
    /** @var string */
    private $apiUrl;

    public function __construct( string $apiUrl = 'https://packagist.org/' )
    {
        $this->apiUrl = $apiUrl;
    }

    public function search( $repositoryName ) : array
    {
        $json = file_get_contents( "{$this->apiUrl}search.json?q={$repositoryName}" );
        $results = json_decode( $json, true );

        if( $results['results'] ) {
            return [ $results['results'][0]['name'] ];
        }

        return [];
    }
}