<?php

class Response
{
    private $code;
    private $message;

    /**
     * Response constructor.
     * @param int|string $code
     * @param string $message
     */
    public function __construct($code, $message)
    {
        $this->code = (string) $code;
        $this->message = (string) $message;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getCodeAndMessage()
    {
        return "{$this->code}: {$this->message}";
    }

    /**
     * @return bool
     */
    public function isSuccessCode()
    {
        $code = (int) $this->getCode();
        return $code >= 200 && $code <= 299;
    }
}