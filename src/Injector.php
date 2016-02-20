<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 14/02/2016
 * Time: 14:55
 */

namespace Craigjbass\PackagistNumber;


use Craigjbass\PackagistNumber\Gateway\GitHub;
use Craigjbass\PackagistNumber\Gateway\Packagist;
use DI\ContainerBuilder;
use function DI\object;

class Injector
{

    public static function getInjector()
    {
        $builder = new ContainerBuilder();
        $builder->useAnnotations( false );
        $builder->addDefinitions( self::getBindings() );

        return $builder->build();
    }

    private static function getBindings()
    {
        return [
            UseCase\GetPackagistNumber::class => object( PackagistNumberCalculator::class ),
            Gateway\SocialCodeStore::class => object( GitHub::class ),
            Gateway\PackageManagerStore::class => object( Packagist::class ),
        ];
    }

}