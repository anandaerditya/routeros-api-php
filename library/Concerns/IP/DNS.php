<?php

namespace Erditya\Concerns\IP;

use Erditya\Exceptions\ErrorException;

trait DNS
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     * @throws ErrorException
     */
    public function ip_dns(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $method_name = strtoupper(__METHOD__);
        $command = $command_parameters;
        $available_commands = [
            'edit', 'export', 'get',
            'print', 'set'
        ];
        $available_parameters = [
            'allow-remote-requests', 'cache-max-ttl', 'cache-size',
            'max-concurrent-queries', 'max-concurrent-tcp-sessions', 'max-udp-packet-size',
            'query-server-timeout', 'query-total-timeout', 'servers',
            'use-doh-server', 'verify-doh-cert'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/dns', $arguments, $method_name);
        }

        $invalid_parameter = implode(', ', $parameter_differences);
        $msg_available_params = implode(', ', $available_parameters);

        throw new ErrorException("ERR::{$method_name} : Invalid parameter(s) {$invalid_parameter}. Available parameters are : {$msg_available_params}");
    }

    // TODO - Cache Method
    // TODO - Static Method
}