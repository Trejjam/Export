<?php
/**
 * Created by PhpStorm.
 * User: jam
 * Date: 27.1.15
 * Time: 19:30
 */

namespace Trejjam\Export;


use Trejjam,
	Nette\Utils\Strings,
	Latte;

class StoreItems
{
	/**
	 * @var string
	 */
	private $file;
	/**
	 * @var string
	 */
	private $shop;
	/**
	 * @var bool
	 */
	private $prepared = FALSE;
	/**
	 * @var resource
	 */
	private $handle;

	function __construct($file, $shop) {
		$this->file = $file;
		$this->shop = $shop;
	}

	protected function getTemplate($name) {
		return __DIR__ . '/' . Strings::firstUpper($this->shop) . '/latte/' . $name . '.latte';
	}
	protected function prepare() {
		$this->handle = fopen('safe://' . $this->file, 'w');

		$headHandle = fopen('safe://' . $this->getTemplate('head'), 'r');
		$head = fread($headHandle, filesize($this->getTemplate('head')));
		fclose($headHandle);

		fwrite($this->handle, $head);

		$this->prepared = TRUE;
	}
	public function addItem(IItem $item) {
		if (!$this->prepared) {
			$this->prepare();
		}

		if ($item->validate()) {
			$latte = new Latte\Engine;

			$xmlItem = $latte->renderToString($this->getTemplate('item'), ['product' => $item]);
			fwrite($this->handle, $xmlItem);
		}
		else {
			throw new ItemIncompletedException('Item is not complete');
		}
	}
	public function completion() {
		if (!$this->prepared) {
			throw new FileEmptyException('File ' . $this->file . ' has not been opened');
		}

		$file = $this->getTemplate('footer');

		$footerHandle = fopen('safe://' . $file, 'r');
		$footer = fread($footerHandle, filesize($file));
		fclose($footerHandle);

		fwrite($this->handle, $footer);

		fclose($this->handle);

		$this->prepared = FALSE;
	}
}
