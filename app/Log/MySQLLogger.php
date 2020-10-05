<?php
namespace App\Log;
use Monolog\Logger;
class MySQLLogger{
/**
     * Create a custom Monolog instance.
     *
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config){
        $logger = new Logger("MySQLLoggingHandler");
        return $logger->pushHandler(new \App\Log\MySQLLoggingHandler());
    }
}
