<?php
namespace App\Log;
// use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
class MySQLLoggingHandler extends AbstractProcessingHandler{



    public function __construct($level = Logger::DEBUG, $bubble = true) {
        $this->table = 'page_visit_logs';
        parent::__construct($level, $bubble);
    }
    protected function write(array $record):void
    {
      if($record['level_name'] === "ERROR")
      return;
      if( $record['context']['type'] === 'visits'){
       $data = array(
           'page'          => $record['context']['page'],
           'user_id'       => $record['context']['user'],
           'created_at'    => now(),
       );
       DB::table($this->table)->insert($data);
      }
    }
}
