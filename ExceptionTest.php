<?php

class BarcodeException extends Exception
{
}

class Barcode
{
    //private $error;

    public function __construct()
    {
    }

    public function line($len)
    {
        if (!is_integer($len)) {
            // $this->error = '不是数字';
            // return false;
            throw new BarcodeException("不是数字");
        }

        if ($len > 5) {
            // $this->error = '超过长度';
            // return false;

            throw new BarcodeException("超过长度");
        }


        echo '生成条形码';
    }

    // public function getError() {
    //     return $this->error;
    // }
}

try {
    $code = new Barcode();
    $ret = $code->line(9);
} catch (BarcodeException $e) {
    echo 'BarcodeException' . $e->getMessage();
} catch (Exception $e) {
    echo 'Exception' . $e->getMessage() . PHP_EOL . $e->getCode() . PHP_EOL . $e->getFile() . PHP_EOL . $e->getLine();
} finally {
    echo PHP_EOL . '总是执行';
}

// if ($ret === false) {
//     echo $code->getError();
// }
