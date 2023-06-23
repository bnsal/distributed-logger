<?php

use Monolog\Logger;

/*
    Author Name: Keshav Bansal
    Author Official Email: Keshav@bnsal.com
    Author Personal Email: keshavbansal0395@gmail.com
*/

return [

    'queue_enabled' => true,

    'queue_driver' => "sqs",

    'disable_default_logging' => true,

    'logging_channel' => [ 'single' ],

    'log_level' => Logger::DEBUG,

    'log_print_level_index' => 10,

    /*Slack config*/
    'slack_channel' => [ 'errorsr' ],

    'slack_level_index' => 201,

];
