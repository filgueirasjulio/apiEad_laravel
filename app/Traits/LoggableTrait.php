<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LoggableTrait
{
    /**
     * Função auxiliar para realização de log.
     *
     * @return void
     */
    protected function log($message = null, $context = [],  $payload = [], string $logChannel = 'stack', string $level = 'debug')
    {
        if ($context instanceof \Throwable) {
            $context = [
                'class' => \get_class($context),
                'message' => $context->getMessage(),
                'code' => $context->getCode(),
                'file' => $context->getFile(),
                'line' => $context->getLine(),
                'payload' => $payload,
            ];
        }
        Log::channel($logChannel)->{$level}($message, \is_array($context) ? $context : json_encode($context));
    }
}