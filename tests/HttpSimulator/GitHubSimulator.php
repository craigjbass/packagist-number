<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 14/02/2016
 * Time: 15:57
 */

namespace Craigjbass\PackagistNumber\HttpSimulator;


trait GitHubSimulator
{

    /**
     * @param $repository
     * @param $contributors
     */
    private function setContributors( $repository, $contributors )
    {

        $githubContributors = [ ];
        foreach ( $contributors as $contributor ) {
            $githubContributors[] = [
                "login"               => $contributor,
                "id"                  => null,
                "avatar_url"          => null,
                "gravatar_id"         => "",
                "url"                 => null,
                "html_url"            => null,
                "followers_url"       => null,
                "following_url"       => null,
                "gists_url"           => null,
                "starred_url"         => null,
                "subscriptions_url"   => null,
                "organizations_url"   => null,
                "repos_url"           => null,
                "events_url"          => null,
                "received_events_url" => null,
                "type"                => "User",
                "site_admin"          => false,
                "contributions"       => null,
            ];
        }
        $json     = json_encode( $githubContributors );
        $location = __DIR__ . "/../../simulator/responses/repos/{$repository}/contributors";
        @mkdir( $location, 0777, true );
        file_put_contents( "$location/response.json", $json );
    }


}