Authorization
=============

Library for export products to 
- Heureka
in [Nette](http://nette.org)

Installation
------------

The best way to install Trejjam/Export is using  [Composer](http://getcomposer.org/):

```sh
$ composer require trejjam/export
```

Configuration
-------------

.neon
```yml
extensions:
	export: Trejjam\DI\ExportExtension

export:
	exportsDir: '%wwwDir%'
    exports   : [heureka]
```
Config
------

The best way for configuration is using [Kdyby/Console](https://github.com/kdyby/console)

```sh
$ composer require kdyby/console
```

Read how to install [Kdyby/Console](https://github.com/Kdyby/Console/blob/master/docs/en/index.md)

```sh
php index.php
```

After successful installation display:

```sh
Available commands:
Cron:export     Export products
	
```

Usage
-----

Products:

```yml
services:
	- Products
```

```php
use Nette,
	Trejjam;
	
class Products implements Trejjam\Export\IProducts {
	/**
     *  {@inheritdoc}
     */
    public function getItems($shop, Nette\Application\UI\Presenter $presenter) {
        $out = [];

        foreach ($this->getProducts() as $v) {
            $item = new Trejjam\Export\Heureka\Item;

            $item->id = $v->id;
            $item->name = $v->name;
            $item->longName = $v->description;
            $item->description = $v->description2;
            $item->url = $presenter->link('//:presenter:action', ['productId' => $v->id,]);
            $item->img;
            
			$imgAlternative = new Trejjam\Export\Heureka\AlternativeImg;
            $imgAlternative->img;
            $item->imgAlternative[] = $imgAlternative;
   
            $item->video;
            $item->price;
            $item->type;
            $item->cpc;
            $item->manufacturer;
            $item->category;
            $item->ean = $v->EAN;
            $item->isbn;
            $item->no = $v->code;
   
            $param = new Trejjam\Export\Heureka\Params;
            $param->name;
            $param->value;
            $item->params = [];
   
            $item->deliveryDate;
   
            $delivery = new Trejjam\Export\Heureka\Delivery;
            $delivery->name;
            $delivery->price;
            $delivery->priceCod;
            $item->delivery[] = $delivery;
            
            $item->groupId;
            $item->accessory;

            $out[] = $item;
        }

        return $out;
    }
}
```

Print available config
----------------------
```sh
$ php index.php Cron:export -p
```

Execute config
----------------------
```sh
$ php index.php Cron:export -e heureka[,...]
```
