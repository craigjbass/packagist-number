<?php

namespace Craigjbass\PackagistNumber;

use Craigjbass\PackagistNumber\Gateway\SocialCodeStore;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Request;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Response;

class PackagistNumberCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var SocialCodeStoreMock */
    private $codeStore;

    /** @var PackageManagerStoreMock */
    private $packages;

    /**
     * @param $expected
     * @param $response
     */
    private function assertLinksIsEqualTo( $expected, Response $response )
    {
        $this->assertEquals( $expected, $response->getLinks() );
    }

    /**
     * @param $response
     */
    private function assertNoRelationshipFoundError( Response $response )
    {
        $this->assertTrue( $response->hasNoRelationship() );
    }

    /**
     * @param $response
     */
    private function assertPackagistNumberIsNull( Response $response )
    {
        $this->assertNull( $response->getPackagistNumber() );
    }

    /**
     * @param $expected
     * @param $response
     */
    private function assertPackagistNumberIsEqualTo( $expected, Response $response )
    {
        $this->assertEquals( $expected, $response->getPackagistNumber() );
    }

    protected function setUp()
    {
        parent::setUp();
        $this->codeStore = new SocialCodeStoreMock();
        $this->packages  = new PackageManagerStoreMock();
    }

    /**
     * @return UseCase\GetPackagistNumber\Response
     */
    private function execute( $starting, $ending )
    {
        return ( new PackagistNumberCalculator( $this->codeStore, $this->packages ) )
            ->execute( new GetPackagistNumber\Request( $starting, $ending ) );
    }

    /**
     * @test
     */
    public function GivenContributorsAreNotLinked_ThenExpectNoLinks()
    {
        $response = $this->execute( 'user1', 'user2' );

        $this->assertLinksIsEqualTo( [ ], $response );
    }

    /**
     * @test
     */
    public function GivenContributorsAreNotLinked_ThenExpectNullPackagistNumber()
    {
        $response = $this->execute( 'user1', 'user2' );

        $this->assertPackagistNumberIsNull( $response );
    }

    /**
     * @test
     */
    public function GivenContributorsAreNotLinked_ThenExpectNoRelationshipFoundError()
    {
        $response = $this->execute( 'user1', 'user2' );

        $this->assertNoRelationshipFoundError( $response );
    }

    /**
     * @test
     */
    public function GivenContributorsAreLinkedByOneRepository_AndIsAValidPackage_ThenExpectPackagistNumberOf1()
    {
        $this->packages->addPackage( 'org1/test' );

        $this->codeStore->addUserRepo( 'user1', 'org1/test' );
        $this->codeStore->addUserRepo( 'user2', 'org1/test' );

        $response = $this->execute( 'user1', 'user2' );

        $this->assertPackagistNumberIsEqualTo( 1, $response );
    }

    /**
     * @test
     */
    public function GivenContributorsAreLinkedByOneRepository_AndIsAValidPackage_ThenExpectOneLinkWithCorrectData()
    {
        $this->packages->addPackage( 'org1/test' );

        $this->codeStore->addUserRepo( 'user1', 'org1/test' );
        $this->codeStore->addUserRepo( 'user2', 'org1/test' );

        $response = $this->execute( 'user1', 'user2' );

        $this->assertEquals( 'org1/test', $response->getLinks()[0]->getPackageName() );
    }

    /**
     * @test
     */
    public function GivenContributorsAreLinkedByOneRepository_AndIsAValidPackageWithDifferentNameToRepo_ThenExpectOneLinkWithCorrectData()
    {
        $this->packages->addPackage( 'org1/test', 'org102/test' );

        $this->codeStore->addUserRepo( 'user1', 'org1/test' );
        $this->codeStore->addUserRepo( 'user2', 'org1/test' );

        $response = $this->execute( 'user1', 'user2' );

        $this->assertEquals( 'org102/test', $response->getLinks()[0]->getPackageName() );
        $this->assertEquals( 'user1', $response->getLinks()[0]->getStartContributor() );
        $this->assertEquals( 'user2', $response->getLinks()[0]->getEndContributor() );
    }


    /**
     * @test
     */
    public function GivenContributorsAreNotLinkedByOneRepository_AndIsAValidPackage_ThenExpectNoRelationshipFoundError()
    {
        $this->packages->addPackage( 'org1/test' );

        $this->codeStore->addUserRepo( 'user1', 'org1/test' );

        $response = $this->execute( 'user1', 'user2' );

        $this->assertNoRelationshipFoundError( $response );
        $this->assertPackagistNumberIsNull( $response );
    }


    /**
     * @test
     */
    public function GivenContributorsAreLinkedByOneRepository_AndNotAValidPackage_ThenExpectNoRelationshipFoundError()
    {
        $this->codeStore->addUserRepo( 'user1', 'org1/test' );
        $this->codeStore->addUserRepo( 'user2', 'org1/test' );

        $response = $this->execute( 'user1', 'user2' );

        $this->assertNoRelationshipFoundError( $response );
        $this->assertPackagistNumberIsNull( $response );
    }



}