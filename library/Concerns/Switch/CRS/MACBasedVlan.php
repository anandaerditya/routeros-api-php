<?php

namespace Erditya\Concerns\Switch\CRS;

trait MACBasedVlan
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function switch_crs_mac_based_vlan(string|array $command_parameters = 'print', array $arguments = []): mixed
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
            'disabled', 'new-customer-vid', 'new-service-vid',
            'src-mac-address'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/ethernet/switch/mac-based-vlan', $arguments);
        }

        return false;
    }
}