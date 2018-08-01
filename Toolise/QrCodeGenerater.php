<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;

class QrCodeGenerater {
	/**
	 * 二维码的信息
	 * @var [type]
	 */
	private $codeStr;

	/**
	 * 二维码大小
	 * @var [type]
	 */
	private $codeSize;

	/**
	 * [$codeTitle description]
	 * @var [type]
	 */
	private $codeTitle;

	/**
	 * 纠错级别： L,M,H,Q
	 * @var [type]
	 */
	private $errorCorrectionLevel;

	/**
	 * logo图标位置
	 * @var [type]
	 */
	private $logoPath;

	/**
	 * 图标大小
	 * @var integer
	 */
	private $logoWidth = 60;

	public function __construct(array $config) {
		$this->codeStr = $config['codeStr'] ?? '';
		$this->codeSize = $config['codeSize'] ?? 200;
	}

	public function setParames(array $parames = []) {
		if ($parames) {
			if (isset($parames['level']) && $parames['level']) {
				$this->setLevel($parames['level']);
			}

			if (isset($parames['title']) && $parames['title']) {
				$this->codeTitle = $parames['title'];
			}

			if (isset($parames['logoPath']) && $parames['logoPath']) {
				$this->logoPath = $parames['logoPath'];
			}

			if (isset($parames['logoWidth']) && $parames['logoWidth']) {
				$this->logoWidth = $parames['logoWidth'];
			}
		}
	}

	public function setLevel(string $level = '') {
		$level = strtoupper($level);
		switch ($level) {
			case 'L':
				$this->errorCorrectionLevel = ErrorCorrectionLevel::LOW;
				break;
			case 'M':
				$this->errorCorrectionLevel = ErrorCorrectionLevel::MEDIUM;
				break;
			case 'H':
				$this->errorCorrectionLevel = ErrorCorrectionLevel::HIGH;
				break;
			case 'Q ':
				$this->errorCorrectionLevel = ErrorCorrectionLevel::QUARTILE;
				break;
			default:
				$this->errorCorrectionLevel = ErrorCorrectionLevel::HIGH;
				break;
		}
	}

	public function getCodeStr():string {
		return $this->CodeStr;
	}

	public function getCodeSize():int {
		return $this->CodeSize;
	}

	public function getLevel():ErrorCorrectionLevel {
		return $this->ErrorCorrectionLevel;
	}

	public function getLogoPath():string {
		return $this->LogoPath;
	}

	public function getlogoWidth():string {
		return $this->logoWidth;
	}

	public function getCodeTitle():string {
		return $this->CodeTitle;
	}


	public function show():string {
		$qrCode = $this->init();
		// Directly output the QR code
		header('Content-Type: '.$qrCode->getContentType());
		return $qrCode->writeString();
	}

	public function makeImg(string $path = '') {
		$qrCode = $this->init();

		$path = $path ? $path : __DIR__ . '/Images/QrCode/' . uniqid() . '.png';

		$qrCode->writeFile($path);
	}

	private function check () {
		if (empty($this->codeStr)) {
			return FALSE;
		}

		return TRUE;
	}

	private function init():QrCode {
		$ret = $this->check();
		if ($ret === false) {
			return '请设置二维码内容';
		}

		// Create a basic QR code
		$qrCode = new QrCode($this->codeStr);
		$qrCode->setSize($this->codeSize);

		// Set advanced options
		$qrCode->setWriterByName('png');
		$qrCode->setMargin(2);
		$qrCode->setEncoding('UTF-8');


		// 点点的颜色
		$qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
		// 点点背后的颜色
		$qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);

		// 纠错级别 点点多与少
		if ($this->errorCorrectionLevel) {
			$qrCode->setErrorCorrectionLevel($this->errorCorrectionLevel);
		}

		// 二维码底部文字
		if ($this->codeTitle) {
			$qrCode->setLabel($this->codeTitle, 16);
		}

		if ($this->logoPath) {
			$qrCode->setLogoPath($this->logoPath);
		}

		if ($this->logoWidth) {
			$qrCode->setLogoWidth($this->logoWidth);
		}

		return $qrCode;
	}


}