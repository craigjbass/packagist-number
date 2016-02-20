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

    private function setPullRequests( $username, $pullRequestRepositories )
    {
        $items = [ ];
        foreach ( $pullRequestRepositories as $repository ) {
            $items[]    = [
                "url"            => null,
                "repository_url" => "https://api.github.com/repos/{$repository}",
                "labels_url"     => null,
                "comments_url"   => null,
                "events_url"     => null,
                "html_url"       => null,
                "id"             => null,
                "number"         => null,
                "title"          => null,
                "user"           => [
                    "login"               => "craigjbass",
                    "id"                  => null,
                    "avatar_url"          => null,
                    "gravatar_id"         => null,
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
                    "type"                => null,
                    "site_admin"          => null,
                ],
                "labels"         => [ ],
                "state"          => null,
                "locked"         => null,
                "assignee"       => null,
                "milestone"      => null,
                "comments"       => null,
                "created_at"     => null,
                "updated_at"     => null,
                "closed_at"      => null,
                "pull_request"   => [
                    "url"       => null,
                    "html_url"  => null,
                    "diff_url"  => null,
                    "patch_url" => null,
                ],
                "body"           => null,
                "score"          => null,
            ];

        }

        $data = [
            'total_count'        => 1,
            'incomplete_results' => false,
            'items'              => $items,
        ];


        $json     = json_encode( $data );
        $location = __DIR__ . "/../../simulator/responses/search/issues/{$username}/1/";
        @mkdir( $location, 0777, true );
        file_put_contents( "$location/response.json", $json );
    }


}