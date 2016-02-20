<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 14/02/2016
 * Time: 10:25
 */

namespace Craigjbass\PackagistNumber\GetPackagistNumber;

class Response implements \Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Response
{
    /**
     * @var int
     */
    private $packagistNumber;
    /**
     * @var Link[]
     */
    private $links;

    public function __construct( $packagistNumber, $links )
    {
        $this->packagistNumber = $packagistNumber;
        $this->links = $links;
    }


    /** @return Link[] */
    public function getLinks(): array
    {
        return $this->links;
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