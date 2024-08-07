<?php

namespace Erditya\Concerns\Switch\CRS;

trait EgressVlanTag
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function switch_crs_egress_vlan_tag(string|array $command_parameters = 'print', array $arguments = []): mixed
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
            'disabled', 'tagged-ports', 'vlan-id'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/ethernet/switch/egress-vlan-tag', $arguments);
        }

        return false;
    }
}