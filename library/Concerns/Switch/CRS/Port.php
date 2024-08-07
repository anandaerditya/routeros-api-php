<?php

namespace Erditya\Concerns\Switch\CRS;

trait Port
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function switch_crs_port(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'edit', 'export', 'find',
            'get', 'print', 'reset-counters',
            'set', 'unset'
        ];
        $available_parameters = [
            '.id', 'action-on-static-station-move', 'allow-fdb-based-vlan-translate',
            'allow-mac-based-customer-vlan-assignment-for', 'allow-mac-based-service-vlan-assignment-for',
            'allow-multicast-loopback', 'allow-unicast-loopback', 'custom-drop-counter-includes',
            'default-customer-pcp', 'default-service-pcp', 'drop-dynamic-mac-move',
            'drop-secure-static-mac-move', 'drop-when-ufdb-entry-src-drop', 'dscp-based-qos-dscp-to-dscp-mapping',
            'egress-customer-tpid-override', 'egress-mirror-to', 'egress-pcp-propagation',
            'egress-service-tpid-override', 'egress-vlan-mode', 'egress-vlan-tag-table-lookup-key',
            'filter-priority-tagged-frame', 'filter-tagged-frame', 'filter-untagged-frame',
            'ingress-customer-tpid-override', 'ingress-mirror-to', 'ingress-mirroring-according-to-vlan',
            'ingress-service-tpid-override', 'isolation-leakage-profile-override', 'learn-limit',
            'pcp-based-qos', 'pcp-or-dscp-based-qos-change', 'pcp-propagation-for-initial-pcp',
            'per-queue-scheduling', 'policy-drop-counter-includes', 'priority-to-queue',
            'qos-scheme-precedence', 'queue-custom-drop-counter0-includes', 'queue-custom-drop-counter1-includes',
            'vlan-type'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/ethernet/switch/port', $arguments);
        }

        return false;
    }
}