<?php

namespace Erditya;

use Erditya\Concerns\Commands;
use Erditya\Exceptions\ErrorException;
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
     * @throws ErrorException
     */
    public function connect(array $credentials): static
    {
        try {
            $method_name = strtoupper(__FUNCTION__);

            # Register credentials into Class Variables
            $this->credentials = $credentials;

            # Create RouterOSInstance/Config instance
            $this->setCredential($this->credentials);

            # Create RouterOSInstance/Client instance, also creating a socket_stream under Client instance.
            $this->client = new Client($this->config);

            return $this;
        } catch (BadCredentialsException|ConnectException|ClientException|ConfigException|QueryException|\Exception $exception) {
            # Set RouterOSInstance/Client instance to null
            $this->client = null;

            return throw new ErrorException("ERR::{$method_name} : {$exception->getMessage()}");
        }
    }

    /**
     * @param string $method
     * @param string $command
     * @param array $parameters
     * @param string $method_name
     * @return mixed
     * @throws ErrorException
     */
    public function send(string $method, string $command, array $parameters, string $method_name):mixed
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
                $exec = $this->client?->query($query)->read(true);
                $err_message = $exec;

                # Catch "after" response
                if (is_array($exec) && array_key_exists('after', $exec)) {
                    if (array_key_exists('message', $err_message['after']) && !empty($exec['after']['message'])) {
                        $error_message = $exec['after']['message'];
                        return throw new ErrorException("ERR::{$method_name} : {$error_message}.");
                    }
                }

                # catch "!trap" response
                if (is_array($exec) && array_key_exists('!trap', $exec)) {
                    if (array_key_exists('message', $err_message['!trap']) && !empty($exec['!trap']['message'])) {
                        $error_message = $exec['!trap']['message'];
                        return throw new ErrorException("ERR::{$method_name} : {$error_message}.");
                    }
                }

                # catch "!re" response
                if (is_array($exec) && array_key_exists('!re', $exec)) {
                    if (array_key_exists('message', $err_message['!re']) && !empty($exec['!re']['message'])) {
                        $error_message = $exec['!re']['message'];
                        return throw new ErrorException("ERR::{$method_name} : {$error_message}.");
                    }
                }

                # catch "!done" response
                if (is_array($exec) && array_key_exists('!done', $exec)) {
                    if (array_key_exists('message', $err_message['!done']) && !empty($exec['!done']['message'])) {
                        $error_message = $exec['!done']['message'];
                        return throw new ErrorException("ERR::{$method_name} : {$error_message}.");
                    }
                }

                # catch "!fatal" response
                if (is_array($exec) && array_key_exists('!fatal', $exec)) {
                    if (array_key_exists('message', $err_message['!fatal']) && !empty($exec['!fatal']['message'])) {
                        $error_message = $exec['!fatal']['message'];
                        return throw new ErrorException("ERR::{$method_name} : {$error_message}.");
                    }
                }

                return true;
            }

            return $this->client?->query($query)->read() ?? false;

        } catch (QueryException|ClientException|ConfigException $exception) {
            return throw new ErrorException("ERR::{$method_name} : {$exception->getMessage()}");
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