<?php
namespace App\Exceptions;

use Exception;

class ValidateException extends Exception {
    public function render() {
        $_SESSION['message'] = $this->getMessage();

        header("location:index.php");
    }
}