<?php
/**
 * Created by PhpStorm.
 * User: jam
 * Date: 27.1.15
 * Time: 18:33
 */

namespace Trejjam\Export\Heureka;


use Trejjam,
	Nette;

class Item extends Nette\Object implements Trejjam\Export\IItem
{
	/** @var int @required */
	public $id;
	/** @var string @required */
	public $name;
	/** @var string */
	public $longName;
	/** @var string */
	public $description;
	/** @var string @required */
	public $url;
	/** @var string */
	public $img;
	/** @var AlternativeImg[] */
	public $imgAlternative = [];
	/** @var string */
	public $video;
	/** @var float */
	public $price;
	/** @var string */
	public $type;
	/** @var float */
	public $cpc;
	/** @var string */
	public $manufacturer;
	/** @var string */
	public $category;
	/** @var string */
	public $ean;
	/** @var string */
	public $isbn;
	/** @var string */
	public $no;
	/** @var Params[] */
	public $params = [];
	/** @var string */
	public $deliveryDate;
	/** @var Delivery[] */
	public $delivery = [];
	/** @var string */
	public $groupId;
	/** @var string */
	public $accessory;

	public function validate() {
		$reflection = $this->getReflection();

		foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $v) {
			if ($v->getAnnotation('required')) {
				if (!isset($this->{$v->getName()})) {
					return FALSE;
				}
			}
		}

		return TRUE;
	}
}
