<?php

namespace Erditya\Concerns\Interface;

trait VLAN
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function interface_vlan(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'comment', 'disable',
            'edit', 'enable', 'export',
            'find', 'get', 'print',
            'remove', 'set'
        ];
        $available_parameters = [
            '.id', 'arp', 'arp-timeout',
            'comment', 'copy-from', 'disabled',
            'interface', 'loop-protect', 'loop-protect-disable-time',
            'loop-protect-send-interval', 'mtu', 'name',
            'use-service-tag', 'vlan-id'
        ];
        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/vlan', $arguments);
        }

        return false;
    }
}