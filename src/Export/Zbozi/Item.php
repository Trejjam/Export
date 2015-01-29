<?php
/**
 * Created by PhpStorm.
 * User: jam
 * Date: 27.1.15
 * Time: 18:33
 */

namespace Trejjam\Export\Zbozi;


use Trejjam,
	Nette;

class Item extends Variant implements Trejjam\Export\IItem
{
	/** @var Variant[] */
	public $variants = [];

	public function validate() {
		$reflection = $this->getReflection();

		foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $v) {
			if ($required = $v->getAnnotation('required')) {
				if ($required instanceof Nette\Utils\ArrayHash) {
					$success = TRUE;

					foreach ($required as $v2) {
						if (!isset($this->{$v2})) {
							$success = FALSE;
							break;
						}
					}

					if ($success) {
						continue;
					}
				}
				if (!isset($this->{$v->getName()})) {
					return FALSE;
				}
			}
		}

		return TRUE;
	}
}
