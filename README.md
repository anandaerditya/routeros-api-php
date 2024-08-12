# Mikrotik RouterOS API PHP Module

![Static Badge](https://img.shields.io/badge/php-8.0_and_up-e74c3c?style=for-the-badge)
![Packagist Version](https://img.shields.io/packagist/v/anandaerditya/routeros-api-php?style=for-the-badge&logo=packagist&logoColor=ffffff&color=%23f28d1a&link=https%3A%2F%2Fpackagist.org%2Fpackages%2Fanandaerditya%2Frouteros-api-php)
![GitHub Release](https://img.shields.io/github/v/release/anandaerditya/routeros-api-php?style=for-the-badge&logo=github&label=github&color=1abc9c&link=https%3A%2F%2Fgithub.com%2Fanandaerditya%2Frouteros-api-php)

This library is using API Client Communicator under PHP Socket, thanks to the repository from [EvilFreelance](https://github.com/EvilFreelancer/routeros-api-php). This library provides built-in methods based on the available configuration under Winbox, with their respective commands and parameters. At the moment, this library supports RouterBoard and Cloud Router Switch with pre-6.43 and post-6.43 versions of RouterOS, as mentioned [in this repository](https://github.com/EvilFreelancer/routeros-api-php).

---

## Changelog

### **1.3.22-hotfix**

1. Add new Exception : ErrorException;
2. Add error handler for each method to catch any errors under mikrotik API.
3. Add new methods :
   - `ip_dhcp_server_lease()`
   - `ip_arp()`
   - `router_switch()`
   - `router_switch_port()`

---

## Requirements

- `PHP` : Version 8.0 and up
- `ext-sockets` : A Socket extension for PHP
- `RouterOS` : **pre-6.43** and **post-6.43** (Tested on **RouterBoard** and **Cloud Router Switch** device)

---

## How to Install

Under composer, just copy this command to begin add this library into your project.

    composer require anandaerditya/routeros-api-php

---

## Using the Library

If you are using Composer Project such Laravel Framework, you can just call the library under `Erditya\RouterOSInstance` class. As follows : 


```php
    include 'vendor/autoload.php';
    
    use Erditya\RouterOSInstance;
    
    $router = new RouterOSInstance();
    
    # Create connection
    $router = $router->connect(
        [
            'host' => '192.168.10.1',
            'user' => 'username',
            'pass' => 'password',
            'port' => 8728 
        ]
    );

    # Example : Fetch all IP Addresses
    if ($router->is_connected()) {
        # Get All Addresses
        var_dump($router->ip_addresses());
        
        # Get address with interface ether2
        var_dump($router->ip_addresses(['interface' => 'ether2']));
        
        # Update address item in ID *2
        var_dump($router->ip_addresses('set', [
            '.id' => '*2',
            'comment' => 'Some Comments'
        ]));
    }
```

Or, another way to approach :

```php
    include 'vendor/autoload.php';
    
    use Erditya\RouterOSInstance;
    
    $router = new RouterOSInstance();
    
    # Create connection
    $router = $router->connect(
        [
            'host' => '192.168.10.1',
            'user' => 'username',
            'pass' => 'password',
            'port' => 8728 
        ]
    );

    # Get All Addresses
    var_dump($router->ip_addresses());
        
    # Get address with interface ether2
    var_dump($router->ip_addresses(['interface' => 'ether2']));
        
    # Update address item in ID *2
    var_dump($router->ip_addresses('set', [
        '.id' => '*2',
        'comment' => 'Some Comments'
    ]));
```

---
    
## Available Methods

List of all methods available in this library at this version :

1. **General**
    - `connect()`
    - `is_connected()`

2. **Interface**
   - `interface_bridge()`
   - `interface_bridge_port()`
   - `interface_bridge_port()`
   - `interface_ethernet()`
   - `interface_list()`
   - `interface_list_member()`
   - `interface_vlan()`

3. **IP**
   - `ip_addresses()`
   - `ip_dhcp_server()`
   - `ip_dhcp_server_network()`
   - `ip_dns()`
   - `ip_firewall_filter()`
   - `ip_firewall_nat()`
   - `ip_hotspot_user_profiles()`
   - `ip_hotspot_users()`
   - `ip_hotspot_server_profiles()`
   - `ip_hotspot_servers()`
   - `ip_hotspot_ip_binding()`
   - `ip_pool()`
   - `ip_route()`
   - `ip_services()`

4. **System**
   - `system_identity()`
   - `system_user_groups()`
   - `system_users()`

5. **Switch (for Cloud Router Switch only)**
   - `switch_crs_egress_vlan_tag()`
   - `switch_crs_mac_based_vlan()`
   - `switch_crs_port()`

---

## Commands & Parameters, and Response

All the methods provided in this library are similar to Winbox's CLI terminal. You can check them under Winbox for more information. All the methods using the command `print` as the default returned the response as an array. If you call the method using another command, such as `add`, `set`, `remove`, etc., the method will return `true`, which indicates it was successfully executed.

---

