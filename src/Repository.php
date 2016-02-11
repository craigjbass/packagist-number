<?php

namespace Craigjbass\PackagistNumber;

class Repository
{

    /** @var string */
    private $name;

    public function __construct( $name )
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

}