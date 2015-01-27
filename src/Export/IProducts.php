<?php
/**
 * Created by PhpStorm.
 * User: jam
 * Date: 27.1.15
 * Time: 21:33
 */

namespace Trejjam\Export;


use Nette,
	Trejjam;

interface IProducts
{
	/**
	 * null - $shop not supported
	 *
	 * @param                                $shop
	 * @param Nette\Application\UI\Presenter $presenter
	 * @return null|IItem[]
	 */
	public function getItems($shop, Nette\Application\UI\Presenter $presenter);
}