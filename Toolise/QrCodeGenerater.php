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
	//'http://origin.ccic.com/wap/index.aspx?key=000000204203626'

	/**
	 * 二维码大小
	 * @var [type]
	 */
	private $codeSize;

	/**
	 * 纠错级别： L,M,H,Q
	 * @var [type]
	 */
	private $errorCorrectionLevel;


	/**
	 * logo图标位置
	 * @var [type]
	 */
	private $logPath;

	/**
	 * 二维码说明文字
	 * @var [type]
	 */
	private $codeTitle;

	public function __construct(array $config) {
		$this->codeStr = $config['codeStr'] ?? '';
		$this->codeSize = $config['codeSize'] ?? 200;

	}

	private function setParames():QrCode {
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
		$qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);

		// 二维码底部文字
		if ($this->codeTitle) {
			$qrCode->setLabel($this->codeTitle, 16);
		}

		if ($this->logPath) {
			$qrCode->setLogoPath($logPath);
			$qrCode->setLogoWidth(150);
		}

		// 外围边框
		//$qrCode->setRoundBlockSize(true);
		// 有效值的展示
		//$qrCode->setValidateResult(false);



		// Save it to a file
		//$qrCode->writeFile(__DIR__.'/qrcode.png');

		// Create a response object
		//$response = new QrCodeResponse($qrCode);

		return $qrCode;
	}

	private function check () {
		if (empty($this->codeStr)) {
			return FALSE;
		}

		return TRUE;
	}

	/*public function setCodeStr(string $code) {
		$this->codeStr = $code;
	}

	public function setCodeSize(int $size) {
		$this->codeSize = $size;
	}*/

	public function setErrorCorrectionLevel(string $level = '') {

		switch ($level) {
			case 'L':
				return ErrorCorrectionLevel::LOW;
				break;
			case 'M':
				return ErrorCorrectionLevel::MEDIUM;
				break;
			case 'H':
				return ErrorCorrectionLevel::HIGH;
				break;
			case 'Q ':
				return ErrorCorrectionLevel::QUARTILE;
				break;
			default:
				return ErrorCorrectionLevel::QUARTILE;
				break;
		}
	}

	public function setLogPath(string $path) {

	}

	public function setCodeTitle(string $title) {

	}


	public function getCodeStr():string {
		return $this->CodeStr;
	}

	public function getCodeSize():int {
		return $this->CodeSize;
	}

	public function getErrorCorrectionLevel():ErrorCorrectionLevel {
		return $this->ErrorCorrectionLevel;
	}

	public function getLogPath():string {
		return $this->LogPath;
	}

	public function getCodeTitle():string {
		return $this->CodeTitle;
	}


	public function show():string {
		$qrCode = $this->setParames();
		// Directly output the QR code
		header('Content-Type: '.$qrCode->getContentType());
		return $qrCode->writeString();
	}

	public function makeImg() {
		$this->setParames();

		$qrCode->writeFile(__DIR__.'/qrcode.png');
	}
}