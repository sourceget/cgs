<?php

namespace Modules\Baidu\Listeners;

use Modules\Baidu\Events\TaoBaoEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaoBaoListener implements ShouldQueue
{
    use InteractsWithQueue;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TaoBaoEvent  $event
     * @return void
     */
    public function handle(TaoBaoEvent $event)
    {
        $event->writeFile();
    }
}
