<?php

namespace Erditya\Concerns\IP;

use Erditya\Exceptions\ErrorException;

trait Route
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     * @throws ErrorException
     */
    public function ip_route(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $method_name = strtoupper(__FUNCTION__);
        $command = $command_parameters;
        $available_commands = [
            'add', 'check', 'comment',
            'disable', 'edit', 'enable',
            'export', 'find', 'get',
            'print', 'remove', 'set',
            'unset'
        ];
        $available_parameters = [
            '.id', 'bgp-as-path', 'bgp-atomic-aggregate',
            'bgp-communities', 'bgp-local-pref', 'bgp-med',
            'bgp-origin', 'bgp-prepend', 'check-gateway',
            'comment', 'copy-from', 'disabled',
            'distance', 'dst-address', 'gateway',
            'pref-src', 'route-tag', 'routing-mark',
            'scope', 'target-scope', 'type',
            'vrf-interface'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/route', $arguments, $method_name);
        }

        $invalid_parameter = implode(', ', $parameter_differences);
        $msg_available_params = implode(', ', $available_parameters);

        throw new ErrorException("ERR::{$method_name} : Invalid parameter(s) {$invalid_parameter}. Available parameters are : {$msg_available_params}");
    }

    // TODO - Cache Method
    // TODO - Rule Method
    // TODO - Nexthop Method
    // TODO - VRF Method
}