# Laravel 5 Teamwork PM API Bridge

![teamwork-graphic](https://cloud.githubusercontent.com/assets/2628905/7765016/853f462c-001e-11e5-90ac-389bf1a6c2fe.jpg)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rossedman/teamwork/badges/quality-score.png?b=master&s=997768a5d702b571dac7d50ae4f85af7236bcf5d)](https://scrutinizer-ci.com/g/rossedman/teamwork/?branch=master)
![Release](https://img.shields.io/github/release/rossedman/teamwork.svg?style=flat)
![License](https://img.shields.io/packagist/l/rossedman/teamwork.svg?style=flat)

This is a simple PHP Client that can connect to the [Teamwork](http://www.teamwork.com) API. 

## Installation
You can simply add it like this

```
composer require "johnrich85/teamwork"
```

## Configuration 

```php
require "vendor/autoload.php";

use GuzzleHttp\Client as Guzzle;
use Johnrich85\Teamwork\Client;
use Johnrich85\Teamwork\Factory as Teamwork;

$client     = new Client(new Guzzle, 'YourSecretKey', 'YourTeamworkUrl');
$teamwork   = new Teamwork($client);
```

You are ready to go now!

* * *
