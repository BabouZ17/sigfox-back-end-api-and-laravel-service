<?php
namespace Enersys\Services;

use Carbon\Carbon;
use Curl\Curl;

/**
 * Class Sigfox
 *
 * The service handling the Sigfox API communications.
 *
 * @package Enersys\Services
 * @version $Id$
 */
class Sigfox
{

    private $curl;

    /**
     * Create a new instance.
     * Open the connection.
     *
     * @param array $config The configuration of the service.
     */
    public function __construct()
    {
        $this->curl = new Curl();
        $this->curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
    }

    /**
     * Destroy the instance.
     * Close the connection.
     */
    public function __destruct()
    {
        $this->curl->close();
    }

    /**
     * Read last message from a sigfox sensor.
     *
     * @param username $username The username of the API account
     * @param password $password The password of the API account
     * @param int $id The ID of the sigfox sensor
     * @return array The measure
     */
    public function read_last($username, $password, $id)
    {
        if (!empty($username) && !empty($password)){

            $this->curl->setHeader('Content-Type', 'application/json');
            $this->curl->setHeader('Authorization', 'Basic ' . base64_encode($username . ':' . $password));
            $this->curl->get('https://backend.sigfox.com/api/devices/' . $id . '/messages?limit=1');
            return json_decode($this->curl->response);
        }
    }

    /**
     * Read multiple messages from a sigfox sensor.
     *
     * @param username $username The username of the API account
     * @param password $password The password of the API account
     * @param int $id The ID of the sigfox sensor
     * @param limit $limit The maximum number of messages you want to receive
     * @return array The measure
     */
    public function read_multiple($username, $password, $id, $limit)
    {
        if (!empty($username) && !empty($password) && is_integer($limit)){

            $this->curl->setHeader('Content-Type', 'application/json');
            $this->curl->setHeader('Authorization', 'Basic ' . base64_encode($username . ':' . $password));
            $this->curl->get('https://backend.sigfox.com/api/devices/' . $id . '/messages?limit=' . $limit);
            return json_decode($this->curl->response);
        }
    }

    /**
     * Read device info from a sigfox device.
     *
     * @param username $username The username of the API account
     * @param password $password The password of the API account
     * @param int $id The ID of the sigfox device
     * @return array the information
     */
    public function read_device_intel($username, $password, $id)
    {
        if (!empty($username) && !empty($password)){

            $this->curl->setHeader('Content-Type', 'application/json');
            $this->curl->setHeader('Authorization', 'Basic ' . base64_encode($username . ':' . $password));
            $this->curl->get('https://backend.sigfox.com/api/devices/' . $id);
            return json_decode($this->curl->response);
        }
    }

    /**
     * Read device token info from a sigfox device.
     *
     * @param username $username The username of the API account
     * @param password $password The password of the API account
     * @param int $id The ID of the sigfox device
     * @return array the information
     */
    public function read_token_intel($username, $password, $id)
    {
        if (!empty($username) && !empty($password)){

            $this->curl->setHeader('Content-Type', 'application/json');
            $this->curl->setHeader('Authorization', 'Basic ' . base64_encode($username . ':' . $password));
            $this->curl->get('https://backend.sigfox.com/api/devices/' . $id . '/token-state');
            return json_decode($this->curl->response);
        }
    }
}
