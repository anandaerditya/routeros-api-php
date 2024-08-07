<?php

namespace Erditya\Concerns\IP;

trait Services
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function ip_services(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'disable', 'edit', 'enable',
            'export', 'find', 'get',
            'print', 'set'
        ];
        $available_parameters = [
            '.id', 'address', 'certificate',
            'disabled', 'port', 'tls-version'
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