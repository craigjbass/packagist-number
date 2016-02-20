<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use Craigjbass\PackagistNumber\Gateway\GitHub;
use Craigjbass\PackagistNumber\Gateway\PackageManagerStore;
use Craigjbass\PackagistNumber\Gateway\Packagist;
use Craigjbass\PackagistNumber\Gateway\SocialCodeStore;
use Craigjbass\PackagistNumber\HttpSimulator\GitHubSimulator;
use Craigjbass\PackagistNumber\HttpSimulator\PackagistSimulator;
use Craigjbass\PackagistNumber\HttpSimulator\Simulator;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber;
use PHPUnit_Framework_Assert as Util;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

    /** @var \Craigjbass\PackagistNumber\GetPackagistNumber\Response */
    private $response;

    use Simulator;
    use GitHubSimulator;
    use PackagistSimulator;

    /**
     * @BeforeScenario
     */
    public function beforeScenario()
    {
        $this->startSimulator();
    }

    /**
     * @AfterScenario
     */
    public function afterScenario()
    {
        $this->endSimulator();
    }

    /**
     * @Given /^there are contributors:$/
     */
    public function thereAreContributors( TableNode $table )
    {
        $repos = [ ];
        foreach ( $table as $row ) {
            $repos[$row['github repo']][] = $row['github contributor'];
        }
        foreach ( $repos as $repoName => $contributors ) {
            $this->setContributors( $repoName, $contributors );
        }
    }

    /**
     * @Given /^github contributors have pull requests to:$/
     */
    public function githubContributorsHavePullRequestsTo( TableNode $table )
    {
        $contributors = [ ];
        foreach ( $table as $row ) {
            $contributors[$row['github contributor']][] = $row['github repo'];
        }
        foreach ( $contributors as $contributor => $repositories ) {
            $this->setPullRequests( $contributor, $repositories );
        }
    }

    /**
     * @Given /^there are packagist packages:$/
     */
    public function thereArePackagistPackages( TableNode $table )
    {
        foreach ( $table as $row ) {
            $repoName = $row['github repo'];
            $this->setSearchData( $repoName, $row['package'], $repoName );
        }
    }

    /**
     * @When /^I find the packagist number between (.*) and (.*)$/
     */
    public function iFindThePackagistNumberBetweenTestContributorandTestContributor( $start, $end )
    {
        $injector = \Craigjbass\PackagistNumber\Injector::getInjector();
        $injector->set(
            SocialCodeStore::class,
            function () {
                return new GitHub( 'http://localhost:47281/' );
            }
        );
        $injector->set(
            PackageManagerStore::class,
            function () {
                return new Packagist( 'http://localhost:47281/' );
            }
        );

        /** @var GetPackagistNumber $usecase */
        $usecase        = $injector->get( GetPackagistNumber::class );
        $this->response = $usecase->execute(
            new \Craigjbass\PackagistNumber\GetPackagistNumber\Request( $start, $end )
        );
    }


    /**
     * @Then /^I expect the packagist number to be (\d+)$/
     */
    public function iExpectThePackagistNumberToBe( $expectedPackagistNumber )
    {
        Util::assertEquals( $expectedPackagistNumber, $this->response->getPackagistNumber() );
    }

    /**
     * @Given /^I expect the repository list to contain only$/
     */
    public function iExpectTheRepositoryListToContainOnly( TableNode $table )
    {
        $expected = [ ];
        foreach ( $table as $row ) {
            $package    = $row['package'];
            $expected[$package] = [
                'package' => $package,
                'start'   => $row['start contributor'],
                'end'     => $row['end contributor'],
            ];
        }

        $links = $this->response->getLinks();
        Util::assertCount( count( $expected ), $links );

        foreach( $links as $link ) {
            $packageName = $link->getPackageName();
            Util::assertTrue( isset($expected[$packageName] ) );
            $expectedLink = $expected[$packageName];
            Util::assertEquals( $expectedLink['start'], $link->getStartContributor() );
            Util::assertEquals( $expectedLink['end'], $link->getEndContributor() );
        }

    }

}
