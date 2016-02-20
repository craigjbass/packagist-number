<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 20/02/2016
 * Time: 17:19
 */

namespace Craigjbass\PackagistNumber\GetPackagistNumber;


class Link implements \Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Link
{

    /** @var string */
    private $packageName;

    /** @var string */
    private $startingContributor;

    /** @var string */
    private $endingContributor;

    public function __construct( string $repository, string $startingContributor, string $endingContributor )
    {
        $this->packageName = $repository;
        $this->startingContributor = $startingContributor;
        $this->endingContributor = $endingContributor;
    }

    public function getPackageName(): string
    {
        return $this->packageName;
    }

    public function getStartContributor(): string
    {
        return $this->startingContributor;
    }

    public function getEndContributor(): string
    {
        return $this->endingContributor;
    }
}