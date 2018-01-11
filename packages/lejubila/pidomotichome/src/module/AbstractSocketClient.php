<?php
/**
 * User: david
 * Date: 11/01/18
 * Time: 22.24
 */

namespace Lejubila\PiDomoticHome\module;

use Exception;

abstract class AbstractSocketClient {

    protected $host;
    protected $port;
    protected $user;
    protected $pass;
    protected $socket;
    protected $prevRequest;


    /**
     * Set connection parameters:
     * $this->host = ....
     * $this->socket = ....
     * $this->user = ....
     * $this->pass = ....
     * @return mixed
     */
    abstract protected function setConnectionParameters();

    public function __construct()
    {
        $this->setConnectionParameters();
        $this->prevRequest = [];
    }

    /**
     * Open the socket connection
     */
    protected  function open()
    {
        $connection = "tcp://".$this->host.":".$this->port;
        $this->socket = stream_socket_client($connection, $errno, $errstr, 30);
        if (!$this->socket) {
            throw new Exception($errstr, $errno);
        }
    }

    /**
     * Close the socket connection
     */
    protected  function close()
    {
        if ( $this->socket )
        {
            fclose($this->socket);
        }
    }

    /**
     * Get stream from socket
     * @throws Exception
     * @return string
     */
    protected  function get()
    {
        if ( !$this->socket )
        {
            throw new Exception("No socket exists");
        }

        $in = "";
        while (!feof($this->socket)) {
            $in .= fgets($this->socket, 1024);
        }
        return $in;
    }

    /**
     * Write stream to socket
     * @param $out string
     * @throws Exception
     */
    protected  function put($out)
    {
        if ( !$this->socket )
        {
            throw new Exception("No socket exists");
        }
        if( fwrite($this->socket, $out."\r\n") == false )
        {
            throw new Exception("Socket read error");
        }
    }

    /**
     * Add credentials for socket server to commend string
     * @param $command
     * @return string
     */
    protected function addCredentialsToCommand($command) {
        if ( !empty($this->user) && !empty($this->pass) ){
            $command = "{$this->user}\r\n{$this->pass}\r\n$command";
        }
        return $command;
    }

    /**
     * @param $command
     * @param $getPrevRequest
     * @return mixed|string
     * @throws Exception
     */
    protected  function execCommand($command, $getPrevRequest=false)
    {
        if ( $getPrevRequest && !empty($this->prevRequest[$command]))
        {
            return $this->prevRequest[$command];
        }

        $this->open();
        $this->put($this->addCredentialsToCommand($command));
        $json_response = $this->get();
        if (!$json_response)
        {
            throw new Exception("Invalid socket client response");
        }

        $response = json_decode($json_response);
        if( $response === null)
        {
            throw new Exception("Invalid json socket client response");
        }

        if (property_exists($response, "error") && $response->error->description)
        {
            throw new Exception($response->error->description, $response->error->code);
        }

        if (property_exists($response, "version") && ($response->version->ver != config('pigarden.pigarden_version_support.ver') || $response->version->sub != config('pigarden.pigarden_version_support.sub') )  )
        {
            throw new Exception("Invalid version of piGarden (required version ".config('pigarden.pigarden_version_support.ver').'.'.config('pigarden.pigarden_version_support.sub').".* )");
        }

        $this->close();
        $this->prevRequest[$command] = $response;
        return $response;
    }

}
