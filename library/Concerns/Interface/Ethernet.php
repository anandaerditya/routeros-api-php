<?php

namespace Erditya\Concerns\Interface;

use Erditya\Exceptions\ErrorException;

trait Ethernet
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     * @throws ErrorException
     */
    public function interface_ethernet(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $method_name = strtoupper(__FUNCTION__);
        $command = $command_parameters;
        $available_commands = [
            'blink', 'cable-test', 'comment',
            'disable', 'edit', 'enable',
            'export', 'find', 'get',
            'monitor', 'print', 'reset-counters',
            'reset-mac-address', 'set', 'unset'
        ];
        $available_parameters = [
            '.id', 'advertise', 'arp',
            'arp-timeout', 'auto-negotiation', 'bandwidth',
            'combo-mode', 'comment', 'disabled',
            'fec-mode', 'full-duplex', 'l2mtu',
            'loop-protect', 'loop-protect-disable-time',
            'loop-protect-send-interval', 'mac-address', 'mdix-enable',
            'mtu', 'name', 'orig-mac-address',
            'rx-flow-control', 'sfp-rate-select', 'sfp-shutdown-temperature',
            'speed', 'tx-flow-control'
        ];
        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'interface/ethernet', $arguments, $method_name);
        }

        $invalid_parameter = implode(', ', $parameter_differences);
        $msg_available_params = implode(', ', $available_parameters);

        throw new ErrorException("ERR::{$method_name} : Invalid parameter(s) {$invalid_parameter}. Available parameters are : {$msg_available_params}");
    }
}