<?php

namespace AnandaErditya;

use AnandaErditya\Modules\Thematic;
use RouterOS\Config;
use RouterOS\Client;
use RouterOS\Exceptions\BadCredentialsException;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\ConnectException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class RouterOS
{
    protected Config $config;
    protected ?Client $client;
    protected array $credentials;

    /**
     * @param array $credentials
     * @return Config|null
     */
    public function setCredential(array $credentials): ?Config
    {
        try {
            return $this->config = new Config($credentials);
        } catch (ConfigException $exception) {
            return null;
        }
    }

    /**
     *  ### Description
     *  Create connection to the RouterOS API Communicator/
     *
     *  ### Available Parameters :
     *  1. **credentials (string)** : This parameter should be array type which consist of :
     *      - **host (string)**,
     *      - **user (string)**,
     *      - **pass (string)**,
     *      - **port (int)**
     *
     * @param array $credentials
     * @return $this
     */
    public function connect(array $credentials): static
    {
        try {
            # Register credentials into Class Variables
            $this->credentials = $credentials;

            # Create RouterOS/Config instance
            $this->setCredential($this->credentials);

            # Create RouterOS/Client instance, also creating a socket_stream under Client instance.
            $this->client = new Client($this->config);

            return $this;
        } catch (BadCredentialsException|ConnectException|ClientException|ConfigException|QueryException $e) {
            # Set RouterOS/Client instance to null
            $this->client = null;

            return $this;
        }
    }

    /**
     * ### Description
     * Send the command into API communicator.
     *
     * ### Available Parameters :
     * 1. **method (string)** : Choose one of this available methods :
     *      - add,
     *      - set,
     *      - print,
     *      - remove.
     * 2. **command (string)** : You can check all available commands under the Winbox's Terminal, or please refer to https://help.mikrotik.com/docs/display/ROS/API#API-Commandword for available commands.
     * 3. **parameters (array)** : The parameters may vary for each command, You can check all available commands under the Winbox's Terminal, or refer to https://help.mikrotik.com/docs/display/ROS/API#API-Commandword for available commands.
     *
     * @param string $method
     * @param string $command
     * @param array $parameters
     * @return mixed
     */
    public function send(string $method, string $command, array $parameters):mixed
    {
        try {
            # Set Allowed methods
            $allowed_methods = ['add', 'set', 'print', 'remove', 'export'];

            if (in_array($method, $allowed_methods)) {
                # Define the command set
                $cmd = "/{$command}/{$method}";

                # Create RouterOS/Query Instance using $cmd command set
                $query = new Query($cmd);

                if (!empty($parameters)) {
                    foreach ($parameters as $key => $value) {
                        $query->equal($key, $value);
                    }
                }

                return $this->client?->query($query)->read() ?? false;
            }

            return false;

        } catch (QueryException|ClientException|ConfigException $exception) {
            return false;
        }
    }

    public function thematic():Thematic
    {
        return new Thematic();
    }

}