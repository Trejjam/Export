<?php
/**
 * Created by PhpStorm.
 * User: jam
 * Date: 27.1.15
 * Time: 21:33
 */

namespace Trejjam\Export;


use Nette,
	Symfony,
	Trejjam;

interface IProducts
{
	/**
	 * null - $shop not supported
	 *
	 * @param                                           $shop
	 * @param Symfony\Component\Console\Command\Command $command
	 * @return null|IItem[]
	 */
	public function getItems($shop, Symfony\Component\Console\Command\Command $command);
}