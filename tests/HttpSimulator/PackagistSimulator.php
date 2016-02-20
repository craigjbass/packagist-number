<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 20/02/2016
 * Time: 16:54
 */

namespace Craigjbass\PackagistNumber\HttpSimulator;


trait PackagistSimulator
{

    /**
     * @param $searchTerm
     * @param $packageName
     * @param $repoName
     */
    private function setSearchData( $searchTerm, $packageName, $repoName )
    {
        $results = [
            [
                "name"        => $packageName,
                "description" => null,
                "url"         => null,
                "repository"  => "https://github.com/$repoName",
                "downloads"   => null,
                "favers"      => null,
            ],
        ];
        $data    = [
            "results" => $results,
            "total"   => 1,
            "next"    => null,
        ];

        $json     = json_encode( $data );
        $location = __DIR__ . "/../../simulator/responses/search.json/{$searchTerm}";
        @mkdir( $location, 0777, true );
        file_put_contents( "$location/response.json", $json );
    }



}