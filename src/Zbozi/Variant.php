<?php
/**
 * Created by PhpStorm.
 * User: jam
 * Date: 27.1.15
 * Time: 18:43
 */

namespace Trejjam\Export\Zbozi;


use Trejjam,
	Nette;

class Variant extends Nette\Object
{
	/** @var string @required(name, nameExt) */
	public $product;
	/** @var string */
	public $name;
	/** @var string */
	public $nameExt;
	/** @var string @required */
	public $description;
	/** @var string @required */
	public $url;
	/** @var string */
	public $img;
	/** @var float */
	public $price;
	/** @var float */
	public $vat;
	/** @var float @required(price, vat) */
	public $priceVat;
	/** @var float */
	public $cpc;
	/** @var float */
	public $cpcSearch;
	/** @var float */
	public $dues;
	/** @var string */
	public $deliveryDate;
	/** @var int */
	public $shopDepots;
	/** @var 0|1 */
	public $unfeatured;
	/** @var string */
	public $type;
	/** @var string */
	public $extraMessage;
	/** @var float */
	public $manufacturer;
	/** @var string */
	public $category;
	/** @var string */
	public $no;
	/** @var string */
	public $ean;
}
