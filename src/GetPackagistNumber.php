<?php

namespace Craigjbass\PackagistNumber;

use Craigjbass\PackagistNumber\Gateway\SocialCodeStore;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Link;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Request;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Response;

class GetPackagistNumber
{
    /**
     * @var SocialCodeStore
     */
    private $socialCodeStore;

    public function __construct( SocialCodeStore $socialCodeStore )
    {
        $this->socialCodeStore = $socialCodeStore;
    }

    public function execute( Request $request ): Response
    {
        $repositories = $this->socialCodeStore->getRepositoriesContributedTo( $request->getStartingContributor() );


        $packagistNumber = null;
        if( count( $repositories ) ) {
            $packagistNumber = 1;
        }


        return new class( $packagistNumber ) implements Response {
            /**
             * @var
             */
            private $packagistNumber;

            public function __construct($packagistNumber )
            {
                $this->packagistNumber = $packagistNumber;
            }


            /** @return Link[] */
            public function getLinks(): array
            {
                return [];
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
        };
    }
}