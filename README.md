# Packagist Number

## Requirements

* PHP 7
* http://php.net/manual/en/features.commandline.webserver.php support in PHP install

## Running

### Behat
```bash
vendor/bin/behat
```

### PHPUnit
```bash
vendor/bin/phpunit ./tests
```

## Task list
- [x] Walking skeleton with edge-to-edge testing
    - [x] Simulator for testing GitHub gateway
    - [x] Simulator for testing Packagist gateway
    - [x] Behat context to test basic acceptance criteria
    - [x] Production code to meet basic acceptance criteria

- [ ] Expose use-case via HTTP endpoint
- [ ] Run one acceptance criteria test against HTTP endpoint
- [ ] Scenario with contributors connected by shared contributor (packagist number of 2)
- [ ] Scenario with contributors connected by packagist number of 3
- [ ] Scenario with very large packagist number e.g. > 50
- [ ] Caching of API result-sets to prevent rate limiting
- [ ] Scenario where Pull Request response is paginated
- [ ] Scenarios where contributions are not made by Pull Request
- [ ] Investigate usage of Google BigQuery using GitHub Archive instead of GitHub API to get repositories contributed to

## Structure

* features - Behat acceptance criteria specifications
* simulator - Used for testing, to simulate GitHub and Packagist API's
* tests - Unit Tests

* src - Production code
