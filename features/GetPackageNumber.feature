Feature: Get packagist number

  Scenario: Get packagist number for contributors joined by one repo
      (this is effectively a rehash of "bacon number",
       except with Packagist packages and GitHub contributors)

    Given there are contributors:
      | github repo  | github contributor |
      | test/package | test-contributor1  |
      | test/package | test-contributor2  |
    And github contributors have pull requests to:
      | github contributor | github repo  |
      | test-contributor1  | test/package |
      | test-contributor2  | test/package |
    And there are packagist packages:
      | package        | github repo  |
      | google/package | test/package |
    When I find the packagist number between test-contributor1 and test-contributor2
    Then I expect the packagist number to be 1
    And I expect the repository list to contain only
      | package        | start contributor | end contributor   |
      | google/package | test-contributor1 | test-contributor2 |