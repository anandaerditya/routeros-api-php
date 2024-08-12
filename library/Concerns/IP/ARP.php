<?php

namespace Erditya\Concerns\IP;

use Erditya\Exceptions\ErrorException;

trait ARP
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     * @throws ErrorException
     */
    public function ip_arp(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $method_name = strtoupper(__FUNCTION__);
        $command = $command_parameters;
        $available_commands = [
            'add', 'comment', 'disable',
            'edit', 'enable', 'export',
            'find', 'print', 'remove',
            'set', 'get'
        ];
        $available_parameters = [
            '.id', 'address', 'comment',
            'copy-from', 'disabled', 'interface',
            'mac-address', 'published'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/arp', $arguments, $method_name);
        }

        $invalid_parameter = implode(', ', $parameter_differences);
        $msg_available_params = implode(', ', $available_parameters);

        throw new ErrorException("ERR::{$method_name} : Invalid parameter(s) {$invalid_parameter}. Available parameters are : {$msg_available_params}");
    }
}