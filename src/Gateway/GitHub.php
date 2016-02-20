<?php
namespace Craigjbass\PackagistNumber\Gateway;

use Craigjbass\PackagistNumber\Repository;

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
        $json = file_get_contents( "{$this->apiUrl}search/issues?q=type:pr+state:closed+author:{$contributor}&per_page=100&page=1" );
        $response = json_decode( $json, true );

        $repositories = [];
        foreach( $response['items'] as $item ) {
            $repositoryUrl  = $item['repository_url'];
            $repositoryName = str_replace( 'https://api.github.com/repos/', '', $repositoryUrl );
            $repositories[$repositoryName] = new Repository( $repositoryName );
        }

        return array_values( $repositories );
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