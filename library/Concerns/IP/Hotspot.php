<?php

namespace Erditya\Concerns\IP;

trait Hotspot
{
    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function ip_hotspot_user_profiles(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'edit', 'export',
            'find', 'get', 'print',
            'remove', 'set', 'unset'
        ];
        $available_parameters = [
            '.id', 'add-mac-cookie', 'address-list',
            'address-pool', 'advertise', 'advertise-interval',
            'advertise-timeout', 'advertise-url', 'copy-from',
            'idle-timeout', 'incoming-filter', 'incoming-packet-mark',
            'insert-queue-before', 'keepalive-timeout', 'mac-cookie-timeout',
            'name', 'on-login', 'on-logout',
            'open-status-page', 'outgoing-filter', 'outgoing-packet-mark',
            'parent-queue', 'queue-type', 'rate-limit',
            'session-timeout', 'shared-users', 'status-autorefresh',
            'transparent-proxy'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/hotspot/user/profile', $arguments);
        }

        return false;
    }

    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function ip_hotspot_users(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'comment', 'disable',
            'edit', 'enable', 'export',
            'find', 'get', 'print',
            'remove', 'reset-counters', 'set'
        ];
        $available_parameters = [
            '.id', 'address', 'comment',
            'copy-from', 'disabled', 'email',
            'limit-bytes-in', 'limit-bytes-out', 'limit-bytes-total',
            'limit-uptime', 'mac-address', 'name',
            'password', 'profile', 'routes',
            'server'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/hotspot/user', $arguments);
        }

        return false;
    }

    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function ip_hotspot_server_profiles(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'edit', 'export',
            'find', 'get', 'print',
            'remove', 'set'
        ];
        $available_parameters = [
            '.id', 'address', 'comment',
            'copy-from', 'disabled', 'email',
            'limit-bytes-in', 'limit-bytes-out', 'limit-bytes-total',
            'limit-uptime', 'mac-address', 'name',
            'password', 'profile', 'routes',
            'server'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/hotspot/profile', $arguments);
        }

        return false;
    }

    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function ip_hotspot_servers(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'edit', 'export',
            'find', 'get', 'print',
            'remove', 'set'
        ];
        $available_parameters = [
            '.id', 'address-pool', 'addresses-per-mac',
            'copy-from', 'disabled', 'idle-timeout',
            'interface', 'keepalive-timeout', 'login-timeout',
            'name', 'profile'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/hotspot', $arguments);
        }

        return false;
    }

    /**
     * @param string|array $command_parameters
     * @param array $arguments
     * @return mixed
     */
    public function ip_hotspot_ip_binding(string|array $command_parameters = 'print', array $arguments = []): mixed
    {
        $command = $command_parameters;
        $available_commands = [
            'add', 'comment', 'disable',
            'edit', 'enable', 'export',
            'find', 'get', 'move',
            'print', 'remove', 'set'
        ];
        $available_parameters = [
            '.id', 'address', 'comment',
            'copy-from', 'disabled', 'mac-address',
            'place-before', 'server', 'to-address',
            'type'
        ];

        # Check if $commandParameters are in array type
        if (is_array($command_parameters)) {
            $arguments = $command_parameters;
            $command = 'print';
        }

        $parameter_differences = array_diff(array_keys($arguments), $available_parameters);

        if (in_array($command, $available_commands) && empty($parameter_differences)) {
            return $this->send($command, 'ip/hotspot/ip-binding', $arguments);
        }

        return false;
    }

    // TODO - Active
    // TODO - Cookie
    // TODO - Walled Garden
    // TODO - Host
    // TODO - Service Ports
}