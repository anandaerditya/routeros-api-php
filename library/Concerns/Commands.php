<?php

namespace Erditya\Concerns;

use Erditya\Concerns\Interface\Bridge;
use Erditya\Concerns\Interface\Ethernet;
use Erditya\Concerns\Interface\Lists;
use Erditya\Concerns\Interface\VLAN;
use Erditya\Concerns\IP\Addresses;
use Erditya\Concerns\IP\DHCPServer;
use Erditya\Concerns\IP\DNS;
use Erditya\Concerns\IP\Firewall;
use Erditya\Concerns\IP\Hotspot;
use Erditya\Concerns\IP\Pool;
use Erditya\Concerns\IP\Route;
use Erditya\Concerns\IP\Services;
use Erditya\Concerns\Switch\CRS\EgressVlanTag;
use Erditya\Concerns\Switch\CRS\MACBasedVlan;
use Erditya\Concerns\Switch\CRS\Port as CRS_Switch_Port;
use Erditya\Concerns\Switch\RouterSwitch;
use Erditya\Concerns\System\Identity;
use Erditya\Concerns\System\Users;

trait Commands
{
    # Interface Section
    use Bridge,
        Ethernet,
        Lists,
        VLAN;

    # IP Section
    use Addresses,
        DHCPServer,
        DNS,
        Firewall,
        Hotspot,
        Pool,
        Route,
        Services;

    # Switch Section
    use CRS_Switch_Port,
        EgressVlanTag,
        MACBasedVlan,
        RouterSwitch;

    # System Section
    use Users,
        Identity;
}