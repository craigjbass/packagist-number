<?php

namespace Craigjbass\PackagistNumber;

use Craigjbass\PackagistNumber\Gateway\SocialCodeStore;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Request;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber\Response;

class GetPackagistNumberTest extends \PHPUnit_Framework_TestCase
{
    /** @var SocialCodeStoreMock */
    private $codeStore;

    /**
     * @param $expected
     * @param $response
     */
    private function assertLinksIsEqualTo($expected, Response $response)
    {
        $this->assertEquals($expected, $response->getLinks());
    }

    /**
     * @param $response
     */
    private function assertNoRelationshipFoundError( Response $response)
    {
        $this->assertTrue($response->hasNoRelationship());
    }

    /**
     * @param $response
     */
    private function assertPackagistNumberIsNull( Response $response)
    {
        $this->assertNull($response->getPackagistNumber());
    }

    /**
     * @param $expected
     * @param $response
     */
    private function assertPackagistNumberIsEqualTo($expected, Response $response)
    {
        $this->assertEquals($expected, $response->getPackagistNumber());
    }

    protected function setUp()
    {
        parent::setUp();
        $this->codeStore = new SocialCodeStoreMock();
    }

    /**
     * @return UseCase\GetPackagistNumber\Response
     */
    private function execute( $starting, $ending )
    {
        return (new GetPackagistNumber( $this->codeStore ))
            ->execute(new GetPackagistNumber\Request( $starting, $ending ));
    }

    /**
     * @test
     */
    public function GivenContributorsAreNotLinked_ThenExpectNoLinks()
    {
        $response = $this->execute( 'user1', 'user2' );

        $this->assertLinksIsEqualTo([], $response);
    }

    /**
     * @test
     */
    public function GivenContributorsAreNotLinked_ThenExpectNullPackagistNumber()
    {
        $response = $this->execute( 'user1', 'user2' );

        $this->assertPackagistNumberIsNull($response);
    }

    /**
     * @test
     */
    public function GivenContributorsAreNotLinked_ThenExpectNoRelationshipFoundError()
    {
        $response = $this->execute( 'user1', 'user2' );

        $this->assertNoRelationshipFoundError($response);
    }

    /**
     * @test
     */
    public function GivenContributorsAreLinkedByOneRepository_ThenExpectPackagistNumberOf1()
    {
        $this->codeStore->addUserRepo( 'user1', 'org1/test' );
        $this->codeStore->addUserRepo( 'user2', 'org1/test' );

        $response = $this->execute( 'user1', 'user2' );

        $this->assertPackagistNumberIsEqualTo(1, $response);
    }

}