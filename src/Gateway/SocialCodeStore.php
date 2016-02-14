<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 11/02/2016
 * Time: 22:07
 */

namespace Craigjbass\PackagistNumber\Gateway;


use Craigjbass\PackagistNumber\Repository;

interface SocialCodeStore
{
    /**
     * @param string $contributor
     * @return Repository[]
     */
    public function getRepositoriesContributedTo( string $contributor ): array;

    /**
     * @param string $repository
     * @return string[]
     */
    public function getContributors( string $repository ): array;
}