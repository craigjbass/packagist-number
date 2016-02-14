<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 14/02/2016
 * Time: 15:10
 */

namespace Craigjbass\PackagistNumber\Gateway;


use Craigjbass\PackagistNumber\HttpSimulator\GitHubSimulator;
use Craigjbass\PackagistNumber\HttpSimulator\Simulator;

class GitHubTest extends \PHPUnit_Framework_TestCase
{

    use Simulator;
    use GitHubSimulator;

    /**
     * @return GitHub
     */
    private function getGithubGateway()
    {
        return new GitHub( 'http://localhost:47281/' );
    }

    /**
     * @test
     */
    public function GivenRepositoryDoesNotExist_WhenGetContributors_ThenReturnEmptyArray()
    {
        $this->startSimulator();
        $github       = $this->getGithubGateway();
        $contributors = $github->getContributors( 'not-found/nothing-to-see-here' );
        $this->assertEquals( [ ], $contributors );
        $this->endSimulator();
    }

    /**
     * @test
     */
    public function GivenRepositoryTestTest_AndHasOneContributorCoder_WhenGetContributors_ThenExpectCoderToBeReturned(
    )
    {
        $this->startSimulator();
        $this->setContributors( "test/test", [ "Coder" ] );

        $github = $this->getGithubGateway();

        $contributors = $github->getContributors( 'test/test' );
        $this->assertEquals( [ 'Coder' ], $contributors );

        $this->endSimulator();
    }

    /**
     * @test
     */
    public function GivenRepositoryTestTest_AndHasThreeContributorsCoder1_Coder2_Coder3_WhenGetContributors_ThenExpectThreeCodersToBeReturned(
    )
    {
        $this->startSimulator();
        $this->setContributors( "test/test", [ "Coder1", "Coder2", "Coder3" ] );

        $github = $this->getGithubGateway();

        $contributors = $github->getContributors( 'test/test' );
        $this->assertEquals( [ 'Coder1', 'Coder2', 'Coder3' ], $contributors );

        $this->endSimulator();
    }

    /**
     * @test
     */
    public function GivenRepositoryOrgRepo_AndHasContributorCraigjbass_WhenGetContributors_ThenExpectThreeCraigjbassToBeReturned(
    )
    {
        $this->startSimulator();
        $this->setContributors( "org/repo", [ "craigjbass" ] );

        $github = $this->getGithubGateway();

        $contributors = $github->getContributors( 'org/repo' );
        $this->assertEquals( [ 'craigjbass' ], $contributors );

        $this->endSimulator();
    }





}
