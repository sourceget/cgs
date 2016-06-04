<?php

namespace App\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Log;

/**
 * Description of LogSql
 *
 * @author Administrator
 */
class LogSql {

    function handle(QueryExecuted $event) {
        if (is_array($event->bindings)) {
            $bindings = $event->bindings;
            $event->sql = preg_replace_callback('~\?~', function($matches) use(&$bindings) {
                        return "'" . array_shift($bindings) . "'";
                    }, $event->sql) . ';';
        }
        Log::debug('SQL --time='.$event->time.' --sql=' .$event->sql);
    }

}
