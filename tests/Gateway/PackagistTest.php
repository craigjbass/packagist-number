<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 20/02/2016
 * Time: 15:55
 */

namespace Craigjbass\PackagistNumber\Gateway;


use Craigjbass\PackagistNumber\HttpSimulator\PackagistSimulator;
use Craigjbass\PackagistNumber\HttpSimulator\Simulator;

class PackagistTest extends \PHPUnit_Framework_TestCase
{
    use Simulator;
    use PackagistSimulator;

    /**
     * @return Packagist
     */
    private function getPackagistGateway()
    {
        return new Packagist( 'http://localhost:47281/' );
    }

    /**
     * @test
     */
    public function GivenNoDataToSearch_WhenSearchedWithOrgTest_ThenExpectEmptyResults()
    {
        $packagist = $this->getPackagistGateway();
        $results   = $packagist->search( 'org/test' );
        $this->assertEquals( [ ], $results );
    }

    /**
     * @test
     */
    public function GivenOrgTestExists_WhenSearchedWithOrgTest_ThenExpectOneResult()
    {
        $repoName    = 'org/test';
        $packageName = 'org/test';
        $searchTerm  = 'org/test';
        $this->setSearchData( $searchTerm, $packageName, $repoName );
        $packagist = $this->getPackagistGateway();

        $results = $packagist->search( 'org/test' );
        $this->assertEquals( [ 'org/test' ], $results );
    }

}