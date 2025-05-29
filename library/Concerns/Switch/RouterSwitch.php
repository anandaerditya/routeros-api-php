<?php

namespace Erditya\Concerns\Switch;

use Erditya\Exceptions\ErrorException;

trait RouterSwitch
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     * @throws ErrorException
     */
    public function router_switch(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $method_name = strtoupper(__FUNCTION__);
        $command = $command_parameters;

        // Available commands under /interface ethernet switch
        $available_commands = [
            'edit',
            'enable',
            'export',
            'find',
            'get',
            'print',
            'remove',
            'reset',
            'reset-counters',
            'set',
            'unset'
        ];


        // Available parameters under /interface ethernet switch
        $available_parameters = [
            '.dead',
            '.id',
            '.nextid',
            'about',
            'append',
            'as-value',
            'brief',
            'compact',
            'count-only',
            'cpu-flow-control',
            'current-learned',
            'custom-drop-packet',
            'detail',
            'driver-rx-byte',
            'driver-rx-packet',
            'driver-tx-byte',
            'driver-tx-packet',
            'fc-fec-block-corrected',
            'fc-fec-block-uncorrected',
            'fc-fec-rx-block',
            'file',
            'follow',
            'follow-only',
            'from',
            'interval',
            'invalid',
            'mirror-source',
            'mirror-target',
            'name',
            'not-learned',
            'policy-drop-packet',
            'proplist',
            'rs-fec-codewords',
            'rs-fec-corrected',
            'rs-fec-symbol-error',
            'rs-fec-uncorrected',
            'rx-1024-1518',
            'rx-1024-max',
            'rx-128-255',
            'rx-1519-max',
            'rx-256-511',
            'rx-512-1023',
            'rx-64',
            'rx-65-127',
            'rx-align-error',
            'rx-broadcast',
            'rx-bytes',
            'rx-carrier-error',
            'rx-code-error',
            'rx-control',
            'rx-drop',
            'rx-error-events',
            'rx-fcs-error',
            'rx-fragment',
            'rx-ip-header-checksum-error',
            'rx-jabber',
            'rx-length-error',
            'rx-multicast',
            'rx-overflow',
            'rx-packet',
            'rx-pause',
            'rx-tcp-checksum-error',
            'rx-too-long',
            'rx-too-short',
            'rx-udp-checksum-error',
            'rx-unicast',
            'rx-unknown-op',
            'show-ids',
            'show-sensitive',
            'stats',
            'stats-detail',
            'switch-all-ports',
            'terse',
            'tx-1024-1518',
            'tx-1024-max',
            'tx-128-255',
            'tx-1519-max',
            'tx-256-511',
            'tx-512-1023',
            'tx-64',
            'tx-65-127',
            'tx-all-queue-drop-byte',
            'tx-all-queue-drop-packet',
            'tx-broadcast',
            'tx-bytes',
            'tx-carrier-sense-error',
            'tx-collision',
            'tx-control',
            'tx-deferred',
            'tx-drop',
            'tx-excessive-collision',
            'tx-excessive-deferred',
            'tx-fcs-error',
            'tx-fragment',
            'tx-jabber',
            'tx-late-collision',
            'tx-mirror-source',
            'tx-mirror-target',
            'tx-multicast',
            'tx-multiple-collision',
            'tx-name',
            'tx-nextid',
            'tx-packet',
            'tx-pause',
            'tx-pause-honored',
            'tx-policy-drop-packet',
            'tx-queue-custom0-drop-byte',
            'tx-queue-custom0-drop-packet',
            'tx-queue-custom1-drop-byte',
            'tx-queue-custom1-drop-packet',
            'tx-queue0-byte',
            'tx-queue0-packet',
            'tx-queue1-byte',
            'tx-queue1-packet',
            'tx-queue2-byte',
            'tx-queue2-packet',
            'tx-queue3-byte',
            'tx-queue3-packet',
            'tx-queue4-byte',
            'tx-queue4-packet',
            'tx-queue5-byte',
            'tx-queue5-packet',
            'tx-queue6-byte',
            'tx-queue6-packet',
            'tx-queue7-byte',
            'tx-queue7-packet',
            'tx-rx-1024-1518',
            'tx-rx-1024-max',
            'tx-rx-128-255',
            'tx-rx-1519-max',
            'tx-rx-256-511',
            'tx-rx-512-1023',
            'tx-rx-64',
            'tx-rx-65-127',
            'tx-single-collision',
            'tx-too-long',
            'tx-too-short',
            'tx-total-collision',
            'tx-traffic',
            'tx-traffic-control',
            'tx-udp-checksum-error',
            'tx-underrun',
            'tx-unicast',
            'tx-unknown-op',
            'type',
            'value-list',
            'value-name',
            'verbose',
            'where',
            'without-paging'
        ];

        # Check if $command_parameters is an array
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        // Validate parameters
        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/ethernet/switch', $arguments, $method_name);
        }

        // Error handling for invalid parameters
        $invalid_parameter = implode(', ', $parameter_differences);
        $msg_available_params = implode(', ', $available_parameters);

        throw new ErrorException("ERR::{$method_name} : Invalid parameter(s) {$invalid_parameter}. Available parameters are: {$msg_available_params}");
    }

    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     * @throws ErrorException
     */
    public function router_switch_port(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $method_name = strtoupper(__FUNCTION__);
        $command = $command_parameters;

        // Available commands under /interface ethernet switch port
        $available_commands = [
            'edit',
            'export',
            'find',
            'print',
            'reset',
            'reset-counters',
            'set',
            'unset',
            'get'
        ];

        // Available parameters under /interface ethernet switch port
        $available_parameters = [
            '.dead',
            '.id',
            '.nextid',
            'about',
            'append',
            'brief',
            'compact',
            'count-only',
            'cpu-flow-control',
            'current-learned',
            'custom-drop-packet',
            'detail',
            'driver-rx-byte',
            'driver-rx-packet',
            'driver-tx-byte',
            'driver-tx-packet',
            'egress-rate',
            'fc-fec-block-corrected',
            'fc-fec-block-uncorrected',
            'fc-fec-rx-block',
            'file',
            'follow',
            'follow-only',
            'from',
            'egress-rate',
            'ingress-rate',
            'interval',
            'invalid',
            'mirror-source',
            'mirror-target',
            'name',
            'not-learned',
            'numbers',
            'policy-drop-packet',
            'proplist',
            'rs-fec-codewords',
            'rs-fec-corrected',
            'rs-fec-symbol-error',
            'rs-fec-uncorrected',
            'rs-unknown-op',
            'rs-1024-1518',
            'rs-64',
            'rs-1024-max',
            'rs-65-127',
            'rs-128-255',
            'rs-1519-max',
            'rs-256-511',
            'rs-512-1023',
            'rx-align-error',
            'rx-broadcast',
            'rx-bytes',
            'rx-carrier-error',
            'rx-code-error',
            'rx-control',
            'rx-drop',
            'rx-error-events',
            'rx-fcs-error',
            'rx-fragment',
            'rx-ip-header-checksum-error',
            'rx-jabber',
            'rx-length-error',
            'rx-multicast',
            'rx-overflow',
            'rx-packet',
            'rx-pause',
            'rx-tcp-checksum-error',
            'rx-too-long',
            'rx-too-short',
            'rx-udp-checksum-error',
            'rx-unicast',
            'running',
            'show-ids',
            'show-sensitive',
            'stats',
            'stats-detail',
            'switch',
            'switch-all-ports',
            'terse',
            'tx-1024-1518',
            'tx-1024-max',
            'tx-128-255',
            'tx-1519-max',
            'tx-256-511',
            'tx-512-1023',
            'tx-64',
            'tx-65-127',
            'tx-all-queue-drop-byte',
            'tx-all-queue-drop-packet',
            'tx-broadcast',
            'tx-bytes',
            'tx-carrier-sense-error',
            'tx-collision',
            'tx-control',
            'tx-deferred',
            'tx-drop',
            'tx-excessive-collision',
            'tx-excessive-deferred',
            'tx-fcs-error',
            'tx-fragment',
            'tx-jabber',
            'tx-late-collision',
            'tx-mirror-source',
            'tx-mirror-target',
            'tx-multicast',
            'tx-multiple-collision',
            'tx-name',
            'tx-nextid',
            'tx-packet',
            'tx-pause',
            'tx-pause-honored',
            'tx-policy-drop-packet',
            'tx-queue-custom0-drop-byte',
            'tx-queue-custom0-drop-packet',
            'tx-queue-custom1-drop-byte',
            'tx-queue-custom1-drop-packet',
            'tx-queue0-byte',
            'tx-queue0-packet',
            'tx-queue1-byte',
            'tx-queue1-packet',
            'tx-queue2-byte',
            'tx-queue2-packet',
            'tx-queue3-byte',
            'tx-queue3-packet',
            'tx-queue4-byte',
            'tx-queue4-packet',
            'tx-queue5-byte',
            'tx-queue5-packet',
            'tx-queue6-byte',
            'tx-queue6-packet',
            'tx-queue7-byte',
            'tx-queue7-packet',
            'tx-rx-1024-1518',
            'tx-rx-1024-max',
            'tx-rx-128-255',
            'tx-rx-1519-max',
            'tx-rx-256-511',
            'tx-rx-512-1023',
            'tx-rx-64',
            'tx-rx-65-127',
            'tx-single-collision',
            'tx-too-long',
            'tx-too-short',
            'tx-total-collision',
            'tx-traffic',
            'tx-underrun',
            'tx-unicast',
            'value-name',
            'verbose',
            'where',
            'without-paging'
        ];

        # Check if $command_parameters is an array
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        // Validate parameters
        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/ethernet/switch/port', $arguments, $method_name);
        }

        // Error handling for invalid parameters
        $invalid_parameter = implode(', ', $parameter_differences);
        $msg_available_params = implode(', ', $available_parameters);

        throw new ErrorException("ERR::{$method_name} : Invalid parameter(s) {$invalid_parameter}. Available parameters are: {$msg_available_params}");
    }

    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     * @throws ErrorException
     */
    public function router_switch_port_isolation(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $method_name = strtoupper(__FUNCTION__);
        $command = $command_parameters;

        // Available commands under /interface ethernet switch port-isolation
        $available_commands = [
            'edit',
            'export',
            'find',
            'get',
            'print',
            'reset',
            'set',
            'unset'
        ];

        // Available parameters under /interface ethernet switch port-isolation
        $available_parameters = [
            '.dead',
            '.id',
            '.nextid',
            'about',
            'append',
            'compact',
            'count-only',
            'detail',
            'file',
            'follow',
            'follow-only',
            'forwarding-override',
            'from',
            'interval',
            'invalid',
            'name',
            'numbers',
            'proplist',
            'show-ids',
            'show-sensitive',
            'switch',
            'terse',
            'value-name',
            'verbose',
            'where',
            'without-paging'
        ];

        # Check if $command_parameters is an array
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        // Validate parameters
        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/ethernet/switch/port-isolation', $arguments, $method_name);
        }

        // Error handling for invalid parameters
        $invalid_parameter = implode(', ', $parameter_differences);
        $msg_available_params = implode(', ', $available_parameters);

        throw new ErrorException("ERR::{$method_name} : Invalid parameter(s) {$invalid_parameter}. Available parameters are: {$msg_available_params}");
    }

    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     * @throws ErrorException
     */
    public function router_switch_rule(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $method_name = strtoupper(__FUNCTION__);
        $command = $command_parameters;

        // Available commands under /interface ethernet switch rule
        $available_commands = [
            'add',
            'comment',
            'disable',
            'edit',
            'enable',
            'export',
            'find',
            'get',
            'move',
            'print',
            'remove',
            'reset',
            'set',
            'unset'
        ];


        // Fully updated parameters under /interface ethernet switch rule
        $available_parameters = [
            '.dead',
            '.id',
            '.nextid',
            'about',
            'append',
            'comment',
            'compact',
            'copy-from',
            'copy-to-cpu',
            'count-only',
            'destination',
            'detail',
            'disabled',
            'dscp',
            'dst-address',
            'dst-address6',
            'dst-mac-address',
            'dst-port',
            'dynamic',
            'file',
            'flow-label',
            'follow',
            'follow-only',
            'forwarding-override',
            'from',
            'ingress-rate',
            'interval',
            'invalid',
            'internal-priority',
            'mac-protocol',
            'mirror',
            'name',
            'new-dst-ports',
            'new-vlan-id',
            'new-vlan-priority',
            'numbers',
            'place-before',
            'policy-drop-packet',
            'ports',
            'proplist',
            'protocol',
            'rate',
            'redirect-to-cpu',
            'rs-fec-codewords',
            'rs-fec-corrected',
            'rs-fec-symbol-error',
            'rs-fec-uncorrected',
            'rs-unknown-op',
            'rs-1024-1518',
            'rs-64',
            'rs-1024-max',
            'rs-65-127',
            'rs-128-255',
            'rs-1519-max',
            'rs-256-511',
            'rs-512-1023',
            'rx-align-error',
            'rx-broadcast',
            'rx-bytes',
            'rx-carrier-error',
            'rx-code-error',
            'rx-control',
            'rx-drop',
            'rx-error-events',
            'rx-fcs-error',
            'rx-fragment',
            'rx-ip-header-checksum-error',
            'rx-jabber',
            'rx-length-error',
            'rx-multicast',
            'rx-overflow',
            'rx-packet',
            'rx-pause',
            'rx-tcp-checksum-error',
            'rx-too-long',
            'rx-too-short',
            'rx-udp-checksum-error',
            'rx-unicast',
            'running',
            'show-ids',
            'show-sensitive',
            'stats',
            'stats-detail',
            'switch',
            'switch-all-ports',
            'src-mac-address',
            'terse',
            'tx-1024-1518',
            'tx-1024-max',
            'tx-128-255',
            'tx-1519-max',
            'tx-256-511',
            'tx-512-1023',
            'tx-64',
            'tx-65-127',
            'tx-all-queue-drop-byte',
            'tx-all-queue-drop-packet',
            'tx-broadcast',
            'tx-bytes',
            'tx-carrier-sense-error',
            'tx-collision',
            'tx-control',
            'tx-deferred',
            'tx-drop',
            'tx-excessive-collision',
            'tx-excessive-deferred',
            'tx-fcs-error',
            'tx-fragment',
            'tx-jabber',
            'tx-late-collision',
            'tx-mirror-source',
            'tx-mirror-target',
            'tx-multicast',
            'tx-multiple-collision',
            'tx-name',
            'tx-nextid',
            'tx-packet',
            'tx-pause',
            'tx-pause-honored',
            'tx-policy-drop-packet',
            'tx-queue-custom0-drop-byte',
            'tx-queue-custom0-drop-packet',
            'tx-queue-custom1-drop-byte',
            'tx-queue-custom1-drop-packet',
            'tx-queue0-byte',
            'tx-queue0-packet',
            'tx-queue1-byte',
            'tx-queue1-packet',
            'tx-queue2-byte',
            'tx-queue2-packet',
            'tx-queue3-byte',
            'tx-queue3-packet',
            'tx-queue4-byte',
            'tx-queue4-packet',
            'tx-queue5-byte',
            'tx-queue5-packet',
            'tx-queue6-byte',
            'tx-queue6-packet',
            'tx-queue7-byte',
            'tx-queue7-packet',
            'tx-rx-1024-1518',
            'tx-rx-1024-max',
            'tx-rx-128-255',
            'tx-rx-1519-max',
            'tx-rx-256-511',
            'tx-rx-512-1023',
            'tx-rx-64',
            'tx-rx-65-127',
            'tx-single-collision',
            'tx-too-long',
            'tx-too-short',
            'tx-total-collision',
            'tx-traffic',
            'tx-underrun',
            'tx-unicast',
            'value-name',
            'verbose',
            'where',
            'without-paging'
        ];

        # Check if $command_parameters is an array
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        // Validate parameters
        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/ethernet/switch/rule', $arguments, $method_name);
        }

        // Error handling for invalid parameters
        $invalid_parameter = implode(', ', $parameter_differences);
        $msg_available_params = implode(', ', $available_parameters);

        throw new ErrorException("ERR::{$method_name} : Invalid parameter(s) {$invalid_parameter}. Available parameters are: {$msg_available_params}");
    }
}