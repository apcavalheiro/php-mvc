<?php

namespace App\Utils;

use Exception;

class Error
{
    private $message;
    private $code;

    public function __construct($objectException = Exception::class)
    {
        $this->code = $objectException->getCode();
        $this->message = $objectException->getMessage();
    }

    public function render()
    {
        $varMessage = $this->message;

        if (file_exists("../app/views/error/" . $this->code . ".php")) {
            require_once "../app/views/error/" . $this->code . ".php";
        } else {
            require_once "../app/views/error/500.php";
        }
        exit;
    }
}