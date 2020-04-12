<?php

namespace App\Listeners;

use Illuminate\Log\Logger;

abstract class BaseListener
{
    protected $logger;

    /**
     * BaseListener constructor.
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
}