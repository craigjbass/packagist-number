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
        $github       = $this->getGithubGateway();
        $contributors = $github->getContributors( 'not-found/nothing-to-see-here' );
        $this->assertEquals( [ ], $contributors );
    }

    /**
     * @test
     */
    public function GivenRepositoryTestTest_AndHasOneContributorCoder_WhenGetContributors_ThenExpectCoderToBeReturned()
    {
        $this->setContributors( "test/test", [ "Coder" ] );

        $github = $this->getGithubGateway();

        $contributors = $github->getContributors( 'test/test' );
        $this->assertEquals( [ 'Coder' ], $contributors );
    }

    /**
     * @test
     */
    public function GivenRepositoryTestTest_AndHasThreeContributorsCoder1_Coder2_Coder3_WhenGetContributors_ThenExpectThreeCodersToBeReturned(
    )
    {
        $this->setContributors( "test/test", [ "Coder1", "Coder2", "Coder3" ] );

        $github = $this->getGithubGateway();

        $contributors = $github->getContributors( 'test/test' );
        $this->assertEquals( [ 'Coder1', 'Coder2', 'Coder3' ], $contributors );
    }

    /**
     * @test
     */
    public function GivenRepositoryOrgRepo_AndHasContributorCraigjbass_WhenGetContributors_ThenExpectOneCraigjbassToBeReturned(
    )
    {
        $this->setContributors( "org/repo", [ "craigjbass" ] );

        $github = $this->getGithubGateway();

        $contributors = $github->getContributors( 'org/repo' );
        $this->assertEquals( [ 'craigjbass' ], $contributors );
    }

    /**
     * @test
     */
    public function GivenUserCoder_AndHasNoPullRequests_WhenGetRepositoriesContributedTo_ThenExpectNoRepositoriesToBeReturned(
    )
    {
        $this->setPullRequests( "Coder", [] );

        $github = $this->getGithubGateway();

        $repositories = $github->getRepositoriesContributedTo( "Coder" );
        $this->assertEquals( [], $repositories );
    }

    /**
     * @test
     */
    public function GivenUserCoder_AndHasOnePullRequest_WhenGetRepositoriesContributedTo_ThenExpectOneRepositoryToBeReturned(
    )
    {
        $this->setPullRequests( "Coder", [ 'org/repo1' ] );

        $github = $this->getGithubGateway();

        $repositories = $github->getRepositoriesContributedTo( "Coder" );
        $this->assertEquals( 'org/repo1', $repositories[0]->getName() );
    }

    /**
     * @test
     */
    public function GivenUserCoder_AndHasTwoPullRequestsToDifferentRepos_WhenGetRepositoriesContributedTo_ThenExpectTwoRepositoriesToBeReturned(
    )
    {
        $this->setPullRequests( "Coder", [ 'org/repo1', 'org/repo2' ] );

        $github = $this->getGithubGateway();

        $repositories = $github->getRepositoriesContributedTo( "Coder" );
        $this->assertEquals( 'org/repo1', $repositories[0]->getName() );
        $this->assertEquals( 'org/repo2', $repositories[1]->getName() );
    }

    /**
     * @test
     */
    public function GivenUserCoder_AndHasTwoPullRequestsToOrgRepo_WhenGetRepositoriesContributedTo_ThenExpectOneRepositoryToBeReturned(
    )
    {
        $this->setPullRequests( "Coder", [ 'org/repo', 'org/repo' ] );

        $github = $this->getGithubGateway();

        $repositories = $github->getRepositoriesContributedTo( "Coder" );
        $this->assertCount( 1, $repositories );
        $this->assertEquals( 'org/repo', $repositories[0]->getName() );
    }

}
