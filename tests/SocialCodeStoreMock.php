<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 14/02/2016
 * Time: 10:16
 */

namespace Craigjbass\PackagistNumber;


use Craigjbass\PackagistNumber\Gateway\SocialCodeStore;

class SocialCodeStoreMock implements SocialCodeStore
{

    private $contributorRepositories = [ ];
    private $repositoryContributors = [ ];

    public function addUserRepo( string $contributor, string $repository )
    {
        if ( !isset($this->contributorRepositories[$contributor]) ) {
            $this->contributorRepositories[$contributor] = [ ];
        }

        if ( !isset($this->repositoryContributors) ) {
            $this->repositoryContributors[$repository] = [ ];
        }

        $this->contributorRepositories[$contributor][] = new Repository( $repository );
        $this->repositoryContributors[$repository][]   = $contributor;
    }

    /**
     * @param string $contributor
     * @return Repository[]
     */
    public function getRepositoriesContributedTo( string $contributor ): array
    {
        if ( !isset($this->contributorRepositories[$contributor]) ) {
            return [ ];
        }

        return $this->contributorRepositories[$contributor];
    }

    /**
     * @param string $repository
     * @return string[]
     */
    public function getContributors( string $repository ): array
    {
        if ( !isset($this->repositoryContributors[$repository]) ) {
            return [ ];
        }

        return $this->repositoryContributors[$repository];
    }
}