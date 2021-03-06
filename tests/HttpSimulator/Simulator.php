<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 14/02/2016
 * Time: 15:55
 */

namespace Craigjbass\PackagistNumber\HttpSimulator;


trait Simulator
{

    /** @var resource */
    private $simulator;

    protected function setUp()
    {
        parent::setUp();
        $this->startSimulator();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->endSimulator();
    }

    private function startSimulator()
    {
        $path = __DIR__. '/../../simulator/responses';
        `rm -Rf $path`;

        $path = __DIR__. '/../../simulator/requests';
        `rm -Rf $path`;

        $script           = __DIR__ . '/../../simulator/http-simulator.php';
        $simulatorCommand = "php -S localhost:47281 {$script}";
        $process          = proc_open(
            $simulatorCommand,
            [
                0 => [ "pipe", "r" ],
                1 => [ "pipe", "w" ],
                2 => [ "file", "/tmp/error-output.txt", "a" ],
            ],
            $pipes
        );

        $this->simulator = $process;
    }

    private function endSimulator()
    {
        proc_terminate( $this->simulator );
    }

}
