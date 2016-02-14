<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 14/02/2016
 * Time: 12:00
 */
namespace Craigjbass\PackagistNumber\Gateway;

interface PackageManagerStore
{
    public function search( $repositoryName );
}