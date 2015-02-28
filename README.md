Endroid PredictionIO Bundle
===========================

*By [endroid](http://endroid.nl/)*

[![Build Status](https://secure.travis-ci.org/endroid/EndroidPredictionIOBundle.png)](http://travis-ci.org/endroid/EndroidPredictionIOBundle)
[![Latest Stable Version](https://poser.pugx.org/endroid/prediction-io-bundle/v/stable.png)](https://packagist.org/packages/endroid/prediction-io-bundle)
[![Total Downloads](https://poser.pugx.org/endroid/prediction-io-bundle/downloads.png)](https://packagist.org/packages/endroid/prediction-io-bundle)

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
    app_key: "Your app key"
    api_url: "http://localhost:8000" // optional
```

## Usage

After installation and configuration, the service can be directly referenced from within your controllers.

```php
<?php
public function recommendAction()
{
    $client = $this->get('endroid.prediction_io');

    // populate
    $client->createUser($userId);
    $client->createItem($itemId);
    $client->recordAction($userId, $itemId, 'view');

    // get recommendations and similar items
    $recommendations = $client->getRecommendations($userId, $engine, $count);
    $similarItems = $client->getSimilarItems($itemId, $engine, $count);
}
```

## Vagrant box

PredictionIO provides a [`Vagrant box`](http://docs.prediction.io/current/installation/install-predictionio-with-virtualbox-vagrant.html)
containing an out-of-the-box PredictionIO server.

## License

This bundle is under the MIT license. For the full copyright and license information, please view the LICENSE file that
was distributed with this source code.
