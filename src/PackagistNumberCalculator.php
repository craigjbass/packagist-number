<?php

namespace Craigjbass\PackagistNumber;

use Craigjbass\PackagistNumber\Gateway\PackageManagerStore;
use Craigjbass\PackagistNumber\Gateway\SocialCodeStore;
use Craigjbass\PackagistNumber\GetPackagistNumber\Link;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Request;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Response;

class PackagistNumberCalculator implements UseCase\GetPackagistNumber
{

    /** @var Link[] */
    private $links = [ ];

    /** @var int */
    private $packagistNumber = null;

    /** @var Repository[] */
    private $repositoriesContributedTo;

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
        $startingContributor             = $request->getStartingContributor();
        $endingContributor               = $request->getEndingContributor();
        $this->repositoriesContributedTo = $this->socialCodeStore->getRepositoriesContributedTo( $startingContributor );

        $hasContributions = count( $this->repositoriesContributedTo );

        if ( !$hasContributions ) {
            return $this->getResponse();
        }

        $this->calculateSocialConnection( $endingContributor, $startingContributor );

        return $this->getResponse();
    }

    /**
     * @param Repository $repository
     * @return array
     */
    private function searchForPackage( Repository $repository )
    {
        return $this->packageManagerStore->search( $repository->getName() );
    }

    /**
     * @return GetPackagistNumber\Response
     */
    private function getResponse()
    {
        return new GetPackagistNumber\Response( $this->packagistNumber, $this->links );
    }

    /**
     * @return mixed
     */
    private function getFirstSearchResult()
    {
        return $this->repositoriesContributedTo[0];
    }

    /**
     * @param $endingContributor
     * @param $startingContributor
     */
    private function calculateSocialConnection( $endingContributor, $startingContributor )
    {
        $repository = $this->getFirstSearchResult();
        $results    = $this->searchForPackage( $repository );
        if ( !empty($results) ) {
            $contributors = $this->socialCodeStore->getContributors( $repository->getName() );

            $isIntersectingInteraction = in_array( $endingContributor, $contributors, true );
            if ( $isIntersectingInteraction ) {
                $this->packagistNumber = 1;
                $this->links[]         = new Link( $results[0], $startingContributor, $endingContributor );
            }
        }
    }
}