<?php

namespace Erditya\Concerns\IP;

use Erditya\Exceptions\ErrorException;

trait Addresses
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function ip_addresses(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'comment', 'disable',
            'edit', 'enable', 'export',
            'find', 'print', 'remove',
            'set', 'get'
        ];
        $available_parameters = [
            '.id', 'broadcast', 'comment',
            'copy-from', 'disabled', 'netmask',
            'network', 'address', 'interface'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/address', $arguments);
        }

        return false;
    }
}