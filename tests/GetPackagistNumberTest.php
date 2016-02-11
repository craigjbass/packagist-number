<?php

namespace Craigjbass\PackagistNumber;

use Craigjbass\PackagistNumber\Gateway\SocialCodeStore;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Request;

class GetPackagistNumberTest extends \PHPUnit_Framework_TestCase
{
    /** @var SocialCodeStore */
    private $codeStore;

    protected function setUp()
    {
        parent::setUp();
        $this->codeStore = new class implements SocialCodeStore {

            public function getRepositoriesContributedTo(string $contributor): array
            {
                return [];
            }
        };
    }


    /**
     * @return UseCase\GetPackagistNumber\Response
     */
    private function execute( $starting, $ending )
    {
        return (new GetPackagistNumber( $this->codeStore ))->execute(new class($starting, $ending) implements Request
        {
            /** @var string */
            private $startingContributor;

            /** @var string */
            private $endingContributor;

            public function __construct($startingContributor, $endingContributor)
            {
                $this->startingContributor = $startingContributor;
                $this->endingContributor = $endingContributor;
            }

            public function getStartingContributor(): string
            {
                return $this->startingContributor;
            }

            public function getEndingContributor(): string
            {
                return $this->endingContributor;
            }
        });
    }

    /**
     * @test
     */
    public function GivenContributorsAreNotLinked_ThenExpectNoLinks()
    {
        $response = $this->execute( 'user1', 'user2' );

        $this->assertEquals( [], $response->getLinks() );
    }

    /**
     * @test
     */
    public function GivenContributorsAreNotLinked_ThenExpectNullPackagistNumber()
    {
        $response = $this->execute( 'user1', 'user2' );

        $this->assertNull( $response->getPackagistNumber() );
    }

    /**
     * @test
     */
    public function GivenContributorsAreNotLinked_ThenExpectNoRelationshipFoundError()
    {
        $response = $this->execute( 'user1', 'user2' );

        $this->assertTrue( $response->hasNoRelationship() );
    }

    /**
     * @test
     */
    public function GivenContributorsAreLinkedByOneRepository_ThenExpectPackagistNumberOf1()
    {
        $this->codeStore = new class implements SocialCodeStore {

            public function getRepositoriesContributedTo(string $contributor): array
            {
                if( $contributor === 'user1' ) {
                    return [ new Repository( "org1/repo1" ) ];
                } else if( $contributor === 'user2' ) {
                    return [ new Repository( "org1/repo1" ) ];
                }
                return [];
            }
        };

        $response = $this->execute( 'user1', 'user2' );

        $this->assertEquals( 1, $response->getPackagistNumber() );
    }




}