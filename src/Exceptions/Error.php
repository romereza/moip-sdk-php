<?php

namespace Moip\Exceptions;

/**
 * Class Error.
 * Represents an error returned by the API.
 */
class Error
{
    /**
     * Code of error.
     *
     * @var int|string
     */
    private $code;

    /**
     * Path of error.
     *
     * @var string
     */
    private $path;

    /**
     * Description of error.
     *
     * @var string
     */
    private $description;

	/**
	 * AdditionalInfo of error.
	 *
	 * @var string
	 */
	private $additionalInfo;

    /**
     * Error constructor.
     *
     * Represents an error return by the API. Commonly used by {@see \Moip\Exceptions\ValidationException}
     *
     * @param string $code        unique error identifier.
     * @param string $path        represents the field where the error ocurred.
     * @param string $description error description.
     * @param string $additionalInfo error additional Info.
     */
    public function __construct($code, $path, $description, $additionalInfo)
    {
        $this->code = $code;
        $this->path = $path;
        $this->description = $description;
        $this->additionalInfo = $additionalInfo;
    }

    /**
     * Returns the unique alphanumeric identifier of the error, ie.: "API-1".
     *
     * @return int|string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns the dotted string representing the field where the error ocurred, ie.: "customer.birthDate".
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns the error description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Creates an Error array from a json string.
     *
     * @param string $json_string string returned by the Moip API
     *
     * @return array
     */
    public static function parseErrors($json_string)
    {
        $error_obj = json_decode($json_string);

		$additionalInfo = (isset($error_obj->additionalInfo))? $error_obj->additionalInfo : null;

        $errors = [];
        if (!empty($error_obj->errors)) {
            foreach ($error_obj->errors as $error) {
                $errors[] = new self($error->code, $error->path, $error->description, $additionalInfo);
            }
        }

        return $errors;
    }

	/**
	 * @return string
	 */
	public function getAdditionalInfo()
	{
		return $this->additionalInfo;
	}
}
