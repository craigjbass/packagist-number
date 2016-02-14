<?php

namespace Craigjbass\PackagistNumber;

use Craigjbass\PackagistNumber\Gateway\PackageManagerStore;
use Craigjbass\PackagistNumber\Gateway\SocialCodeStore;
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
        $repositories = $this->socialCodeStore->getRepositoriesContributedTo( $request->getStartingContributor() );

        $packagistNumber = null;
        if ( count( $repositories ) ) {
            $repository = $repositories[0];

            if ( $this->packageManagerStore->search( $repository->getName() ) ) {
                $contributors = $this->socialCodeStore->getContributors( $repository->getName() );

                if ( in_array( $request->getEndingContributor(), $contributors, true ) ) {
                    $packagistNumber = 1;
                }
            }
        }

        return new GetPackagistNumber\Response( $packagistNumber );
    }
}