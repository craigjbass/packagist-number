<?php

namespace Craigjbass\PackagistNumber;

use Craigjbass\PackagistNumber\Gateway\PackageManagerStore;
use Craigjbass\PackagistNumber\Gateway\SocialCodeStore;
use Craigjbass\PackagistNumber\GetPackagistNumber\Link;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Request;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Response;

class PackagistNumberCalculator implements UseCase\GetPackagistNumber
{
    /** @var SocialCodeStore */
    private $socialCodeStore;

    /** @var PackageManagerStore */
    private $packageManagerStore;

    public function __construct( SocialCodeStore $socialCodeStore, PackageManagerStore $packageManagerStore )
    {
        $this->socialCodeStore     = $socialCodeStore;
        $this->packageManagerStore = $packageManagerStore;
    }

    public function execute( Request $request ): Response
    {
        $startingContributor = $request->getStartingContributor();
        $endingContributor   = $request->getEndingContributor();
        $repositories        = $this->socialCodeStore->getRepositoriesContributedTo( $startingContributor );

        $links           = [ ];
        $packagistNumber = null;
        if ( count( $repositories ) ) {
            $repository = $repositories[0];

            $results = $this->packageManagerStore->search( $repository->getName() );
            if ( $results ) {
                $contributors = $this->socialCodeStore->getContributors( $repository->getName() );


                if ( in_array( $endingContributor, $contributors, true ) ) {
                    $packagistNumber = 1;
                    $links[]         = new Link( $results[0], $startingContributor, $endingContributor );
                }
            }
        }

        return new GetPackagistNumber\Response( $packagistNumber, $links );
    }
}