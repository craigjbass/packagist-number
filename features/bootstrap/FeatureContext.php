<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use Craigjbass\PackagistNumber\HttpSimulator\GitHubSimulator;
use Craigjbass\PackagistNumber\HttpSimulator\Simulator;
use Craigjbass\PackagistNumber\UseCase\GetPackagistNumber;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

    use Simulator;
    use GitHubSimulator;

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
    public function thereAreContributors(TableNode $table)
    {
        $repos = [];
        foreach( $table as $row ) {
            $repos[$row['github repo']][] = $row['github contributor'];
        }
        foreach( $repos as $repoName => $contributors ) {
            $this->setContributors( $repoName, $contributors );
        }
    }

    /**
     * @Given /^github contributors have pull requests to:$/
     */
    public function githubContributorsHavePullRequestsTo( TableNode $table )
    {
        $contributors = [];
        foreach( $table as $row ) {
            $contributors[$row['github contributor']][] = $row['github repo'];
        }
        foreach( $contributors as $contributor => $repositories ) {
            $this->setPullRequests( $contributor, $repositories );
        }
    }

    /**
     * @Given /^there are packagist packages:$/
     */
    public function thereArePackagistPackages(TableNode $table)
    {

    }

    /**
     * @When /^I execute with (.*?) and (.*?)$/
     */
    public function iExecuteWithTestContributorandTestContributor($arg1, $arg2)
    {

    }

    /**
     * @Then /^I expect the packagist number to be (\d+)$/
     */
    public function iExpectThePackagistNumberToBe($arg1)
    {

    }

    /**
     * @Given /^I expect the repository list to contain only$/
     */
    public function iExpectTheRepositoryListToContainOnly(TableNode $table)
    {

    }

    /**
     * @When /^I find the packagist number between (.*) and (.*)$/
     */
    public function iFindThePackagistNumberBetweenTestContributorandTestContributor($start, $end)
    {
        $injector = \Craigjbass\PackagistNumber\Injector::getInjector();
        /** @var GetPackagistNumber $usecase */
        $usecase = $injector->get( GetPackagistNumber::class );


    }

}
