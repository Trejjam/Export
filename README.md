Export
======

Library for export products to 
- [Heureka](http://www.heureka.cz/)
- [Zbozi](http://www.zbozi.cz/)

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
    exports   : 
        heureka: yes
        zbozi  : yes
```
Config
------

For run is used [Kdyby/Console](https://github.com/kdyby/console)
Read how to setup [Kdyby/Console](https://github.com/Kdyby/Console/blob/master/docs/en/index.md)

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
    public function getItems(Trejjam\Export\StoreItems $storage, $shop, Symfony\Component\Console\Command\Command $command, Symfony\Component\Console\Input\InputInterface $input, Symfony\Component\Console\Output\OutputInterface $output) {
        foreach ($this->getProducts() as $v) {
            if ($shop=='heureka') {
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
	
	            $storage->addItem($item);
			}
			else if ($shop=='zbozi') {
				$item = new Trejjam\Export\Zbozi\Item;
			
				$item->product;
				$item->name;
				$item->nameExt;
				$item->description;
				$item->url;
				$item->img;
				$item->price;
				$item->vat;
				$item->priceVat;
				$item->cpc;
				$item->cpcSearch;
				$item->dues;
				$item->deliveryDate;
				$item->shopDepots;
				$item->unfeatured;
				$item->type;
				$item->extraMessage;
				$item->manufacturer;
				$item->category;
				$item->no;
				
				$variant=new Trejjam\Export\Zbozi\Variant;
				$variant->nameExt; //rewrite Item::properties
				$item->variants[]=$variant;
				
				$storage->addItem($item);
			}
        }
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
$ php index.php Cron:export -e heureka -e zbozi
```
