<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/02/2016
 * Time: 21:38
 */

namespace Craigjbass\PackagistNumber\UseCase\GetPackagistNumber;


interface Response
{

    /** @return Link[] */
    public function getLinks(): array;

    /** @return int */
    public function getPackagistNumber();

    public function hasNoRelationship(): bool;

}