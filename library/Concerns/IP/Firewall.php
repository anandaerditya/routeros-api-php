<?php

namespace Erditya\Concerns\IP;

trait Firewall
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function ip_firewall_filter(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'disable', 'enable',
            'find', 'print', 'reset-counters',
            'set', 'comment', 'edit',
            'export', 'move', 'remove',
            'reset-counters-all', 'unset', 'get'
        ];
        $available_parameters = [
            '.id', 'action', 'address-list',
            'address-list-timeout', 'chain', 'comment',
            'connection', 'content', 'copy-from',
            'disabled', 'dscp', 'dst-address',
            'dst-address-list', 'dst-address-type',
            'dst-limit', 'dst-port', 'fragment',
            'hotspot', 'icmp-options', 'in-bridge-port',
            'in-bridge-port-list', 'in-interface', 'in-interface-list',
            'ingress-priority', 'ipsec-policy', 'ipv4-options',
            'jump-target', 'layer7-protocol', 'limit',
            'log', 'log-prefix', 'nth',
            'out-bridge-port', 'out-bridge-port-list', 'out-interface',
            'out-interface-list', 'p2p', 'packet-mark',
            'packet-size', 'per-connection-classifier', 'place-before',
            'port', 'priority', 'protocol',
            'psd', 'random', 'reject-with',
            'routing-mark', 'routing-table', 'src-address',
            'src-address-list', 'src-address-type', 'src-mac-address',
            'src-port', 'tcp-flags', 'tcp-mss',
            'time', 'tls-host', 'ttl'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/firewall/filter', $arguments);
        }

        return false;
    }

    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function ip_firewall_nat(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'disable', 'enable',
            'find', 'print', 'reset-counters',
            'set', 'comment', 'edit',
            'export', 'move', 'remove',
            'reset-counters-all', 'unset', 'get'
        ];
        $available_parameters = [
            '.id', 'action', 'address-list',
            'address-list-timeout', 'chain', 'comment',
            'connection', 'content', 'copy-from',
            'disabled', 'dscp', 'dst-address',
            'dst-address-list', 'dst-address-type',
            'dst-limit', 'dst-port', 'fragment',
            'hotspot', 'icmp-options', 'in-bridge-port',
            'in-bridge-port-list', 'in-interface', 'in-interface-list',
            'ingress-priority', 'ipsec-policy', 'ipv4-options',
            'jump-target', 'layer7-protocol', 'limit',
            'log', 'log-prefix', 'nth',
            'out-bridge-port', 'out-bridge-port-list',
            'out-interface', 'out-interface-list', 'packet-mark',
            'packet-size', 'per-connection-classifier', 'place-before',
            'port', 'priority', 'protocol',
            'psd', 'random', 'routing-mark',
            'routing-table', 'same-not-by-dst', 'src-address',
            'src-address-list', 'src-address-type', 'src-mac-address',
            'src-port', 'tcp-mss', 'time',
            'tls-host', 'to-addresses', 'to-ports',
            'ttl'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/firewall/nat', $arguments);
        }

        return false;
    }
}