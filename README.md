Endroid PredictionIO Bundle
===========================

*By [endroid](http://endroid.nl/)*

[![Build Status](http://img.shields.io/travis/endroid/EndroidPredictionIOBundle.svg)](http://travis-ci.org/endroid/EndroidPredictionIOBundle)
[![Latest Stable Version](http://img.shields.io/packagist/v/endroid/prediction-io-bundle.svg)](https://packagist.org/packages/endroid/prediction-io-bundle)
[![Total Downloads](http://img.shields.io/packagist/dt/endroid/prediction-io-bundle.svg)](https://packagist.org/packages/endroid/prediction-io-bundle)
[![License](http://img.shields.io/packagist/l/endroid/prediction-io-bundle.svg)](https://packagist.org/packages/endroid/prediction-io-bundle)

This bundle provides easy integration with [`PredictionIO`](http://prediction.io/). PredictionIO is an open source machine
learning server for software developers to create predictive features, such as personalization, recommendation and content
discovery. Based on [`Apache Mahout`](http://mahout.apache.org/) scalable machine learning libraries.

The bundle registers the Endroid [`PredictionIO`](https://github.com/endroid/PredictionIO) client as a service in your
Symfony project. This client can then be used to register actions between users and items and to retrieve recommendations
provided by any PredictionIO server. Applications range from showing recommended products in a web shop to discovering
relevant experts in a social collaboration network.

[![knpbundles.com](http://knpbundles.com/endroid/EndroidPredictionIOBundle/badge-short)](http://knpbundles.com/endroid/EndroidPredictionIOBundle)

## Requirements

* Symfony
* Dependencies:
 * [`endroid/PredictionIO`](https://github.com/endroid/PredictionIO)

## Installation

Use [Composer](https://getcomposer.org/) to install the bundle.

``` bash
$ composer require endroid/prediction-io-bundle
```

Then enable the bundle via the kernel.

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Endroid\Bundle\PredictionIOBundle\EndroidPredictionIOBundle(),
    );
}
```

## Configuration

### config.yml

```yaml
endroid_prediction_io:
    eventServer:
        url: %prediction_io.eventServer.url%
    apps:
        yashry:
            key: %prediction_io.yashry.key%
            engines:
                complementarypurchase:
                    url: http://localhost:8000
                productranking:
                    url: http://localhost:8001
                viewedthenbought:
                    url: http://localhost:8002
                recommendation:
                    url: http://localhost:8003
                similarproduct:
                    url: http://localhost:8004
                leadscoring:
                    url: http://localhost:8005
        edfa3ly:
            key: %prediction_io.edfa3ly.key%
            engines:
                complementarypurchase:
                    url: http://localhost:8006
                leadscoring:
                    url: http://localhost:8007
```

## Usage

After installation and configuration, the client can be directly referenced from within your controllers.

```php
<?php

use Endroid\PredictionIO\EventClient;
use Endroid\PredictionIO\EngineClient;

/** @var EventClient $yashryEventClient */
$yashryEventClient = $this->get('endroid.prediction_io.yashry.event_client');
/** @var EngineClient $yashryRecommendationEngineClient */
$yashryRecommendationEngineClient = $this->get('endroid.prediction_io.yashry.recommendation.engine_client');
/** @var EngineClient $yashrySimilarProductEngineClient */
$yashrySimilarProductEngineClient = $this->get('endroid.prediction_io.yashry.similarproduct.engine_client');

// Populate with users and items
$yashryEventClient->createUser($userId);
$yashryEventClient->createItem($itemId);

// Record actions
$client->recordUserActionOnItem('view', $userId, $itemId);

// Return recommendations
$recommendedItems = $yashryRecommendationEngineClient->getRecommendedItems($userId, $itemCount);
$similarItems = $yashrySimilarProductEngineClient->getSimilarItems($itemId, $itemCount);
```

## Vagrant box

PredictionIO provides a [`Vagrant box`](https://docs.prediction.io/install/install-vagrant/)
containing an out-of-the-box PredictionIO server.

## Versioning

Semantic versioning ([semver](http://semver.org/)) is applied.

## License

This bundle is under the MIT license. For the full copyright and license information, please view the LICENSE file that
was distributed with this source code.
