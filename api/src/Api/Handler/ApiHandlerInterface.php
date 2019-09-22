<?php

namespace App\Api\Handler;

interface ApiHandlerInterface
{
    /**
     * @param array $parameters
     * @return bool
     */
    public function canHandle(array $parameters): bool;

    /**
     * @param array $parameters
     */
    public function handle(array $parameters);
}
