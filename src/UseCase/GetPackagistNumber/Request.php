<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/02/2016
 * Time: 21:50
 */

namespace Craigjbass\PackagistNumber\UseCase\GetPackagistNumber;


interface Request
{
    public function getStartingContributor(): string;

    public function getEndingContributor(): string;
}