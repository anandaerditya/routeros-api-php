<?php

namespace Erditya\Concerns\IP;

use Erditya\Exceptions\ErrorException;

trait DHCPServer
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     * @throws ErrorException
     */
    public function ip_dhcp_server(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $method_name = strtoupper(__FUNCTION__);
        $command = $command_parameters;
        $available_commands = [
            'add', 'config', 'disable',
            'edit', 'enable', 'export',
            'find', 'print', 'remove',
            'set'
        ];
        $available_parameters = [
            '.id', 'add-arp', 'address-pool',
            'allow-dual-stack-queue', 'always-broadcast', 'authoritative',
            'bootp-lease-time', 'bootp-support', 'client-mac-limit',
            'conflict-detection', 'copy-from', 'delay-threshold',
            'dhcp-option-set', 'disabled', 'insert-queue-before',
            'interface', 'lease-script', 'lease-time',
            'name', 'parent-queue', 'relay',
            'src-address', 'use-framed-as-classless', 'use-radius'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/dhcp-server', $arguments, $method_name);
        }

        $invalid_parameter = implode(', ', $parameter_differences);
        $msg_available_params = implode(', ', $available_parameters);

        throw new ErrorException("ERR::{$method_name} : Invalid parameter(s) {$invalid_parameter}. Available parameters are : {$msg_available_params}");
    }

    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     * @throws ErrorException
     */
    public function ip_dhcp_server_network(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $method_name = strtoupper(__FUNCTION__);
        $command = $command_parameters;
        $available_commands = [
            'add', 'comment', 'edit',
            'export', 'find', 'get',
            'print', 'remove', 'set'
        ];
        $available_parameters = [
            '.id', 'address', 'boot-file-name',
            'caps-manager', 'comment', 'copy-from',
            'dhcp-option', 'dhcp-option-set', 'dns-none',
            'dns-server', 'domain', 'gateway',
            'netmask', 'next-server', 'ntp-server',
            'wins-server'
        ];
        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/dhcp-server/network', $arguments, $method_name);
        }

        $invalid_parameter = implode(', ', $parameter_differences);
        $msg_available_params = implode(', ', $available_parameters);

        throw new ErrorException("ERR::{$method_name} : Invalid parameter(s) {$invalid_parameter}. Available parameters are : {$msg_available_params}");
    }

    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     * @throws ErrorException
     */
    public function ip_dhcp_server_lease(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $method_name = strtoupper(__FUNCTION__);
        $command = $command_parameters;
        $available_commands = [
            'add', 'check-status', 'comment',
            'disable', 'edit', 'enable',
            'export', 'find', 'get',
            'make-static', 'print', 'remove',
            'set', 'unset'
        ];
        $available_parameters = [
            '.id', 'address', 'address-lists',
            'allow-dual-stack-queue', 'always-broadcast', 'block-access',
            'client-id', 'comment', 'copy-from',
            'dhcp-option', 'dhcp-option-set', 'disabled',
            'insert-queue-before', 'lease-time', 'mac-address',
            'rate-limit', 'server', 'use-src-mac'
        ];
        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/dhcp-server/lease', $arguments, $method_name);
        }

        $invalid_parameter = implode(', ', $parameter_differences);
        $msg_available_params = implode(', ', $available_parameters);

        throw new ErrorException("ERR::{$method_name} : Invalid parameter(s) {$invalid_parameter}. Available parameters are : {$msg_available_params}");
    }

    // TODO - Alert
    // TODO - Config
    // TODO - Option
    // TODO - Vendor Class ID
}