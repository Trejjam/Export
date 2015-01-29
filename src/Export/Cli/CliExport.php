<?php
/**
 * Created by PhpStorm.
 * User: jam
 * Date: 27.1.15
 * Time: 20:39
 */

namespace Trejjam\Export;


use Symfony\Component\Console\Command\Command,
	Symfony\Component\Console\Input\InputInterface,
	Symfony\Component\Console\Output\OutputInterface,
	Symfony\Component\Console\Input\InputOption;

use Nette,
	Trejjam;

class CliExport extends Command
{
	/**
	 * @var
	 */
	private $config;
	/**
	 * @var IProducts
	 */
	private $products;

	public function __construct($config, IProducts $products) {
		parent::__construct();

		$this->config = $config;
		$this->products = $products;
	}

	protected function configure() {
		$this->setName('Cron:export')
			 ->setDescription('Export products')
			 ->addOption('print-exports', 'p', InputOption::VALUE_NONE, 'Print available exports')
			 ->addOption('proceed-exports', 'e', InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL);
	}
	protected function execute(InputInterface $input, OutputInterface $output) {
		$printExports = $input->getOption('print-exports');
		$proceedExports = $input->getOption('proceed-exports');

		if ($printExports) {
			$output->writeln('Available exports:');

			foreach ($this->config['exports'] as $k => $v) {
				if ($v) {
					$output->writeln('- ' . $k);
				}
			}
		}

		if (count($proceedExports)) {
			foreach ($proceedExports as $v) {
				if (is_null($v)) {
					continue;
				}
				if (!isset($this->config['exports'][$v]) || !$this->config['exports'][$v]) {
					continue;
				}

				$storage = new Trejjam\Export\StoreItems($this->config['exportsDir'] . '/' . $v . '.xml', $v);

				$this->products->getItems($storage, $v, $this, $input, $output);

				$storage->completion();

				$output->writeln('Export ' . $v . ' done');
			}
		}
	}
}