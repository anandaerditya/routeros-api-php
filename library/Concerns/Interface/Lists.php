<?php

namespace Erditya\Concerns\Interface;

trait Lists
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function interface_list(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'comment', 'edit',
            'export', 'find', 'get',
            'print', 'remove', 'set'
        ];
        $available_parameters = [
            '.id', 'comment', 'copy-from',
            'exclude', 'include', 'name'
        ];
        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/list', $arguments);
        }

        return false;
    }

    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function interface_list_member(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'comment', 'disable',
            'edit', 'enable', 'export',
            'find', 'get', 'print',
            'remove', 'set'
        ];
        $available_parameters = [
            '.id', 'comment', 'copy-from',
            'disabled', 'interface', 'list'
        ];
        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/list/member', $arguments);
        }

        return false;
    }
}