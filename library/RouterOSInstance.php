<?php

namespace Erditya;

use Erditya\Concerns\Commands;
use RouterOS\Config;
use RouterOS\Client;
use RouterOS\Exceptions\BadCredentialsException;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\ConnectException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;

class RouterOSInstance
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
     * @param array $credentials
     * @return RouterOSInstance
     */
    public function connect(array $credentials): static
    {
        try {
            # Register credentials into Class Variables
            $this->credentials = $credentials;

            # Create RouterOSInstance/Config instance
            $this->setCredential($this->credentials);

            # Create RouterOSInstance/Client instance, also creating a socket_stream under Client instance.
            $this->client = new Client($this->config);

            return $this;
        } catch (BadCredentialsException|ConnectException|ClientException|ConfigException|QueryException|\Exception $e) {
            # Set RouterOSInstance/Client instance to null
            $this->client = null;

            return $this;
        }
    }

    /**
     * @param string $method
     * @param string $command
     * @param array $parameters
     * @return mixed
     */
    public function send(string $method, string $command, array $parameters):mixed
    {
        try {
            # Define the command set
            $cmd = "/{$command}/{$method}";

            # Create RouterOSInstance/Query Instance using $cmd command set
            $query = new Query($cmd);

            if (!empty($parameters)) {
                foreach ($parameters as $key => $value) {
                    $method == 'print' ?
                        $query->where($key, $value) :
                        $query->equal($key, $value);
                }
            }

            $non_fetch_command = ['add', 'comment', 'disable', 'edit', 'enable', 'export', 'remove', 'set', 'move', 'reset-counters', 'reset-counters-all', 'unset'];

            if (in_array($method, $non_fetch_command)) {
                return empty($this->client?->query($query)->read());
            }

            return $this->client?->query($query)->read() ?? false;

        } catch (QueryException|ClientException|ConfigException $exception) {
            return $exception;
        }
    }

    /**
     * @return bool
     */
    public function is_connected(): bool
    {
        return !$this->client == null;
    }


    # Built-in Commands
    use Commands;
}