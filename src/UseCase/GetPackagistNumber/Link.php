<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/02/2016
 * Time: 21:39
 */

namespace Craigjbass\PackagistNumber\UseCase\GetPackagistNumber;


interface Link
{
    public function getPackageName(): string;

    public function getStartContributor(): string;

    public function getEndContributor(): string;
}