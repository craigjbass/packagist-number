<?php
namespace Craigjbass\PackagistNumber\Gateway;

class GitHub implements SocialCodeStore
{
    /** @var string */
    private $apiUrl;

    public function __construct( string $apiUrl = 'https://api.github.com/' )
    {
        $this->apiUrl = $apiUrl;
    }

    /**
     * @param string $contributor
     * @return \Craigjbass\PackagistNumber\Repository[]
     */
    public function getRepositoriesContributedTo( string $contributor ): array
    {

    }

    /**
     * @param string $repository
     * @return string[]
     */
    public function getContributors( string $repository ): array
    {
        $json = file_get_contents( "{$this->apiUrl}repos/$repository/contributors" );
        $contributors = json_decode( $json, true );

        $array = [];
        if( empty( $contributors ) ) {
            return [];
        }

        foreach( $contributors as $contributor ) {
            $array[] = $contributor['login'];
        }
        return $array;
    }
}