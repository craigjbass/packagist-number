<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{

    /**
     * @Given /^there are contributors:$/
     */
    public function thereAreContributors(TableNode $table)
    {

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
     * @When /^I find the packagist number between test\-contributor1 and test\-contributor2$/
     */
    public function iFindThePackagistNumberBetweenTestContributorandTestContributor($arg1, $arg2)
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}