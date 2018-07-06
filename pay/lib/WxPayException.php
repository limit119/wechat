<?php
namespace wechat\pay\lib;

use Exception;
class WxPayException extends Exception{
	public function errorMessage()
	{
		return $this->getMessage();
	}
}

?>