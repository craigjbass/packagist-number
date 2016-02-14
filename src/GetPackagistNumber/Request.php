<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 14/02/2016
 * Time: 10:21
 */

namespace Craigjbass\PackagistNumber\GetPackagistNumber;

class Request implements \Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Request
{
    /** @var string */
    private $startingContributor;

    /** @var string */
    private $endingContributor;

    public function __construct($startingContributor, $endingContributor)
    {
        $this->startingContributor = $startingContributor;
        $this->endingContributor = $endingContributor;
    }

    public function getStartingContributor(): string
    {
        return $this->startingContributor;
    }

    public function getEndingContributor(): string
    {
        return $this->endingContributor;
    }
}