<?php

class LoggerUtil
{
    private $logger = array();

    /**
     * @param string $message
     */
    public function log($message)
    {
        $debugBacktrace = debug_backtrace();

        $this->logger[] = '--------------------------------------------------';
        $this->logger[] = 'FILE : '.$debugBacktrace[0]['file'];
        $this->logger[] = 'LINE : '.$debugBacktrace[0]['line'];
        $this->logger[] = 'METHOD : '.$debugBacktrace[1]['function'];

        $this->logger[] = 'MESSAGE : '.$message;
        $this->logger[] = '--------------------------------------------------';
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->logger);
    }

    /**
     * @return array
     */
    public function getAllLogs()
    {
        return $this->logger;
    }
}