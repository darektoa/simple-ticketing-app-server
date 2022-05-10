<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Support\Collection;

class ErrorException extends Exception
{
	private $errors;


	public function __construct(
		string $message = 'Failed',
		int $code = 400,
		array|Collection $errors = [],
		?Throwable $previous = null,
	) {
		parent::__construct($message, $code, $previous);
		$this->errors = $errors;
	}


	public function getErrors() {
		return $this->errors;
	}
}