<?php

namespace Erditya\Concerns\IP;

trait Pool
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function ip_pool(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'comment', 'edit',
            'export', 'find', 'get',
            'print', 'remove', 'set'
        ];
        $available_parameters = [
            '.id', 'comment', 'copy-from',
            'name', 'next-pool', 'ranges'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/pool', $arguments);
        }

        return false;
    }

    // TODO - Used
}