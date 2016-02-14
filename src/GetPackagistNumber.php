<?php

namespace Craigjbass\PackagistNumber;

use Craigjbass\PackagistNumber\Gateway\SocialCodeStore;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Link;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Request;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Response;

class GetPackagistNumber
{
    /** @var SocialCodeStore */
    private $socialCodeStore;

    public function __construct( SocialCodeStore $socialCodeStore )
    {
        $this->socialCodeStore = $socialCodeStore;
    }

    public function execute( Request $request ): Response
    {
        $repositories = $this->socialCodeStore->getRepositoriesContributedTo( $request->getStartingContributor() );

        $packagistNumber = null;
        if ( count( $repositories ) ) {
            $packagistNumber = 1;
        }

        return new GetPackagistNumber\Response( $packagistNumber );
    }
}