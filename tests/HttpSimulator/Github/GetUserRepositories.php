<?php
/**
 * Created by PhpStorm.
 * User: craig
 * Date: 09/02/2016
 * Time: 22:37
 */

namespace HttpSimulator\Github;


class GetUserRepositories
{

    public function execute()
    {
        $json = /** @lang JSON */
            <<<JSON
[
   {
      "id":19870173,
      "name":"binvis",
      "full_name":"craigjbass/binvis",
      "owner":{
         "login":"craigjbass",
         "id":1889973,
         "avatar_url":"https://avatars.githubusercontent.com/u/1889973?v=3",
         "gravatar_id":"",
         "url":"https://api.github.com/users/craigjbass",
         "html_url":"https://github.com/craigjbass",
         "followers_url":"https://api.github.com/users/craigjbass/followers",
         "following_url":"https://api.github.com/users/craigjbass/following{/other_user}",
         "gists_url":"https://api.github.com/users/craigjbass/gists{/gist_id}",
         "starred_url":"https://api.github.com/users/craigjbass/starred{/owner}{/repo}",
         "subscriptions_url":"https://api.github.com/users/craigjbass/subscriptions",
         "organizations_url":"https://api.github.com/users/craigjbass/orgs",
         "repos_url":"https://api.github.com/users/craigjbass/repos",
         "events_url":"https://api.github.com/users/craigjbass/events{/privacy}",
         "received_events_url":"https://api.github.com/users/craigjbass/received_events",
         "type":"User",
         "site_admin":false
      },
      "private":false,
      "html_url":"https://github.com/craigjbass/binvis",
      "description":"",
      "fork":false,
      "url":"https://api.github.com/repos/craigjbass/binvis",
      "forks_url":"https://api.github.com/repos/craigjbass/binvis/forks",
      "keys_url":"https://api.github.com/repos/craigjbass/binvis/keys{/key_id}",
      "collaborators_url":"https://api.github.com/repos/craigjbass/binvis/collaborators{/collaborator}",
      "teams_url":"https://api.github.com/repos/craigjbass/binvis/teams",
      "hooks_url":"https://api.github.com/repos/craigjbass/binvis/hooks",
      "issue_events_url":"https://api.github.com/repos/craigjbass/binvis/issues/events{/number}",
      "events_url":"https://api.github.com/repos/craigjbass/binvis/events",
      "assignees_url":"https://api.github.com/repos/craigjbass/binvis/assignees{/user}",
      "branches_url":"https://api.github.com/repos/craigjbass/binvis/branches{/branch}",
      "tags_url":"https://api.github.com/repos/craigjbass/binvis/tags",
      "blobs_url":"https://api.github.com/repos/craigjbass/binvis/git/blobs{/sha}",
      "git_tags_url":"https://api.github.com/repos/craigjbass/binvis/git/tags{/sha}",
      "git_refs_url":"https://api.github.com/repos/craigjbass/binvis/git/refs{/sha}",
      "trees_url":"https://api.github.com/repos/craigjbass/binvis/git/trees{/sha}",
      "statuses_url":"https://api.github.com/repos/craigjbass/binvis/statuses/{sha}",
      "languages_url":"https://api.github.com/repos/craigjbass/binvis/languages",
      "stargazers_url":"https://api.github.com/repos/craigjbass/binvis/stargazers",
      "contributors_url":"https://api.github.com/repos/craigjbass/binvis/contributors",
      "subscribers_url":"https://api.github.com/repos/craigjbass/binvis/subscribers",
      "subscription_url":"https://api.github.com/repos/craigjbass/binvis/subscription",
      "commits_url":"https://api.github.com/repos/craigjbass/binvis/commits{/sha}",
      "git_commits_url":"https://api.github.com/repos/craigjbass/binvis/git/commits{/sha}",
      "comments_url":"https://api.github.com/repos/craigjbass/binvis/comments{/number}",
      "issue_comment_url":"https://api.github.com/repos/craigjbass/binvis/issues/comments{/number}",
      "contents_url":"https://api.github.com/repos/craigjbass/binvis/contents/{+path}",
      "compare_url":"https://api.github.com/repos/craigjbass/binvis/compare/{base}...{head}",
      "merges_url":"https://api.github.com/repos/craigjbass/binvis/merges",
      "archive_url":"https://api.github.com/repos/craigjbass/binvis/{archive_format}{/ref}",
      "downloads_url":"https://api.github.com/repos/craigjbass/binvis/downloads",
      "issues_url":"https://api.github.com/repos/craigjbass/binvis/issues{/number}",
      "pulls_url":"https://api.github.com/repos/craigjbass/binvis/pulls{/number}",
      "milestones_url":"https://api.github.com/repos/craigjbass/binvis/milestones{/number}",
      "notifications_url":"https://api.github.com/repos/craigjbass/binvis/notifications{?since,all,participating}",
      "labels_url":"https://api.github.com/repos/craigjbass/binvis/labels{/name}",
      "releases_url":"https://api.github.com/repos/craigjbass/binvis/releases{/id}",
      "deployments_url":"https://api.github.com/repos/craigjbass/binvis/deployments",
      "created_at":"2014-05-16T20:43:05Z",
      "updated_at":"2014-05-21T09:53:30Z",
      "pushed_at":"2014-05-16T22:21:02Z",
      "git_url":"git://github.com/craigjbass/binvis.git",
      "ssh_url":"git@github.com:craigjbass/binvis.git",
      "clone_url":"https://github.com/craigjbass/binvis.git",
      "svn_url":"https://github.com/craigjbass/binvis",
      "homepage":null,
      "size":224,
      "stargazers_count":0,
      "watchers_count":0,
      "language":"Groovy",
      "has_issues":true,
      "has_downloads":true,
      "has_wiki":true,
      "has_pages":false,
      "forks_count":0,
      "mirror_url":null,
      "open_issues_count":0,
      "forks":0,
      "open_issues":0,
      "watchers":0,
      "default_branch":"master"
   }
]
JSON;

    }

}