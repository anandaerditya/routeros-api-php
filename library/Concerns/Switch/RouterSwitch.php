<?php

namespace Erditya\Concerns\Switch;

trait RouterSwitch
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function router_switch(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'edit', 'export', 'find',
            'get', 'print', 'reset-counters',
            'set', 'unset'
        ];
        $available_parameters = [
            '.id', 'cpu-flow-control', 'mirror-source',
            'mirror-target', 'name', 'switch-all-ports'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/ethernet/switch', $arguments);
        }

        return false;
    }

    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function router_switch_port(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'edit', 'export', 'find',
            'get', 'print', 'reset-counters',
            'set', 'unset'
        ];
        $available_parameters = [
            '.id', 'default-vlan-id', 'vlan-header',
            'vlan-mode'
        ];
        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/ethernet/switch/port', $arguments);
        }

        return false;
    }

    // TODO - Host
    // TODO - Port Isolation
    // TODO - Rule
    // TODO - VLAN
}