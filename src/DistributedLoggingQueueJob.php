<?php

namespace Bnsal\DistributedLogger;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Bnsal\DistributedLogger\DistributedLoggingController;

use Log;

class DistributedLoggingQueueJob implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($log) {
        $this->data = $log;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        try {
            if( $this->data ) {
                if( json_decode($this->data)->on_slack ) {
                    \Log::stack( config('bnsallogging.slack_channel', ['stack']) )->emergency($this->data);
                }
            }

            \Log::stack( config('bnsallogging.logging_channel', ['stack']) )->emergency($this->data);
        } catch ( \Exception $e ) {
            \Log::stack( config('bnsallogging.logging_channel', ['stack']) )->emergency($e);
        }

        
    }
}
