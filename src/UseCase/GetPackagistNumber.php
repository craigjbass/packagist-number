<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 14/02/2016
 * Time: 14:55
 */
namespace Craigjbass\PackagistNumber\UseCase;

interface GetPackagistNumber
{
    public function execute( GetPackagistNumber\Request $request ) : GetPackagistNumber\Response;
}