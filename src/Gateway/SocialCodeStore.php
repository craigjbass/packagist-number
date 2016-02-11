<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/02/2016
 * Time: 22:07
 */

namespace Craigjbass\PackagistNumber\Gateway;


interface SocialCodeStore
{
    public function getRepositoriesContributedTo(string $contributor): array;
}