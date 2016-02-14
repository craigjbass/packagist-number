<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 14/02/2016
 * Time: 10:51
 */

namespace Craigjbass\PackagistNumber;


use Craigjbass\PackagistNumber\Gateway\PackageManagerStore;

class PackageManagerStoreMock implements PackageManagerStore
{

    private $packages = [ ];

    public function search( $repositoryName )
    {
        if ( isset($this->packages[$repositoryName]) ) {
            return $this->packages[$repositoryName];
        }

        return [ ];
    }

    public function addPackage( $string )
    {
        $this->packages[$string] = true;
    }


}