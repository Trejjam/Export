<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 26. 10. 2014
 * Time: 17:38
 */

namespace Trejjam\Export\DI;

use Nette;

class ExportExtension extends Nette\DI\CompilerExtension
{
	private $defaults = [
		'exportsDir' => '%wwwDir%',
		'exports'    => [
			'heureka' => TRUE,
			'zbozi'   => TRUE,
		],
	];

	public function loadConfiguration() {
		parent::loadConfiguration();

		$builder = $this->getContainerBuilder();
		$config = $this->getConfig($this->defaults);

		if (class_exists('\Symfony\Component\Console\Command\Command')) {
			$command = [
				'cliExport' => 'Cli\Export',
			];

			foreach ($command as $k => $v) {
				$builder->addDefinition($this->prefix($k))
						->setClass('Trejjam\Export\\' . $v, [
							$config,
						])
						->addTag('kdyby.console.command');
			}
		}
	}
}
