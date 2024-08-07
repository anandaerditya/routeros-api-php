<?php

namespace Erditya\Concerns\System;

trait Identity
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function system_identity(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'edit', 'export', 'get',
            'print', 'set'
        ];
        $available_parameters = ['name'];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'system/identity', $arguments);
        }

        return false;
    }
}