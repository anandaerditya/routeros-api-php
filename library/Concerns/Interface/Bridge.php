<?php

namespace Erditya\Concerns\Interface;

trait Bridge
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function interface_bridge(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'comment', 'disable',
            'edit', 'enable', 'export',
            'find', 'get', 'host',
            'monitor', 'print', 'remove',
            'set'
        ];
        $available_parameters = [
            '.id', 'add-dhcp-option82', 'admin-mac',
            'ageing-time', 'arp', 'arp-timeout',
            'auto-mac', 'comment', 'copy-from',
            'dhcp-snooping', 'disabled', 'ether-type',
            'fast-forward', 'forward-delay', 'frame-types',
            'igmp-snooping', 'igmp-version', 'ingress-filtering',
            'last-member-interval', 'last-member-query-count', 'max-hops',
            'max-message-age', 'membership-interval', 'mtu',
            'multicast-querier', 'multicast-router', 'name',
            'priority', 'protocol-mode', 'pvid',
            'querier-interval', 'query-interval', 'query-response-interval',
            'region-name', 'region-revision', 'startup-query-count',
            'startup-query-interval', 'transmit-hold-count', 'vlan-filtering'
        ];
        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/bridge', $arguments);
        }

        return false;
    }

    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function interface_bridge_port(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'comment', 'disable',
            'edit', 'enable', 'export',
            'find', 'get', 'monitor',
            'move', 'print', 'remove',
            'set'
        ];
        $available_parameters = [
            '.id', 'auto-isolate', 'bpdu-guard',
            'bridge', 'broadcast-flood', 'comment',
            'copy-from', 'disabled', 'edge',
            'fast-leave', 'frame-types', 'horizon',
            'hw', 'ingress-filtering', 'interface',
            'internal-path-cost', 'learn', 'multicast-router',
            'path-cost', 'place-before', 'point-to-point',
            'priority', 'pvid', 'restricted-role',
            'restricted-tcn', 'tag-stacking', 'trusted',
            'unknown-multicast-flood', 'unknown-unicast-flood'
        ];
        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/bridge/port', $arguments);
        }

        return false;
    }

    // TODO - Calea
    // TODO - Filter
    // TODO - Host
    // TODO - MDB
    // TODO - MSTI
    // TODO - NAT
    // TODO - Port
    // TODO - Port Controller
    // TODO - Port Extender
    // TODO - Settings
    // TODO - VLAN
    // TODO - Bridge Port MST Override
}