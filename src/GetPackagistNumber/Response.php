<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 14/02/2016
 * Time: 10:25
 */

namespace Craigjbass\PackagistNumber\GetPackagistNumber;


class Response implements \Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Response {
    /**
     * @var
     */
    private $packagistNumber;

    public function __construct($packagistNumber )
    {
        $this->packagistNumber = $packagistNumber;
    }


    /** @return Link[] */
    public function getLinks(): array
    {
        return [];
    }

    /** @return int */
    public function getPackagistNumber()
    {
        return $this->packagistNumber;
    }

    public function hasNoRelationship(): bool
    {
        return true;
    }
}