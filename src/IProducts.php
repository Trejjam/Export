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
	 * @param                                                  $shop
	 * @param Symfony\Component\Console\Command\Command        $command
	 * @param Symfony\Component\Console\Input\InputInterface   $input
	 * @param Symfony\Component\Console\Output\OutputInterface $output
	 */
	public function getItems(Trejjam\Export\StoreItems $storage, $shop, Symfony\Component\Console\Command\Command $command, Symfony\Component\Console\Input\InputInterface $input, Symfony\Component\Console\Output\OutputInterface $output);
}
