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

    private $userRepo = [ ];

    public function addUserRepo( string $contributor, string $repository )
    {
        if ( !isset($this->userRepo[$contributor]) ) {
            $this->userRepo[$contributor] = [ ];
        }
        $this->userRepo[$contributor][] = new Repository( $repository );
    }

    public function getRepositoriesContributedTo( string $contributor ): array
    {
        if ( !isset($this->userRepo[$contributor]) ) {
            return [ ];
        }

        return $this->userRepo[$contributor];
    }
}