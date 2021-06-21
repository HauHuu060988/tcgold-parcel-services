<?php

namespace App;

use Dotenv\Dotenv;

/**
 * Class Parcel
 * @package App
 */
class Parcel
{
    /**
     * @var
     */
    private $host;

    /**
     * Parcel constructor.
     */
    public function __construct()
    {
        $dotenv = Dotenv::create(dirname(__DIR__, 1));
        $dotenv->load();
        $this->host = getenv('API_HOST');
    }

    /**
     * @param $payload
     * @return mixed
     */
    public function register($payload)
    {
        $url = "{$this->host}/api/v1/register";
        $payload = json_encode($payload);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($response, $headerSize);
        $result = json_decode($body, true);

        if (curl_errno($ch)) {
            echo 'Library error: ' . curl_error($ch) . PHP_EOL;
        }
        curl_close($ch);

        return array_merge(['httpCode' => $httpcode], $result);
    }

    /**
     * @param $jwt
     * @param $payload
     * @return array
     */
    public function createParcel($jwt, $payload)
    {
        $url = "{$this->host}/api/v1/parcels";
        $payload = json_encode($payload);
        $authorization = "Authorization: Bearer {$jwt}";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($response, $headerSize);
        $result = json_decode($body, true);

        if (curl_errno($ch)) {
            echo 'Library error: ' . curl_error($ch) . PHP_EOL;
        }
        curl_close($ch);

        return array_merge(['httpCode' => $httpcode], $result);
    }

    /**
     * @param $jwt
     * @param $parcelID
     * @return array
     */
    public function getParcel($jwt, $parcelID)
    {
        $url = "{$this->host}/api/v1/parcels/{$parcelID}";
        $authorization = "Authorization: Bearer {$jwt}";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($response, $headerSize);
        $result = json_decode($body, true);

        if (curl_errno($ch)) {
            echo 'Library error: ' . curl_error($ch) . PHP_EOL;
        }
        curl_close($ch);

        return array_merge(['httpCode' => $httpcode], $result);
    }

    /**
     * @param $jwt
     * @param $parcelID
     * @param $payload
     * @return array
     */
    public function updateParcel($jwt, $parcelID, $payload)
    {
        $url = "{$this->host}/api/v1/parcels/{$parcelID}";
        $payload = json_encode($payload);
        $authorization = "Authorization: Bearer {$jwt}";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'put');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($response, $headerSize);
        $result = json_decode($body, true);

        if (curl_errno($ch)) {
            echo 'Library error: ' . curl_error($ch) . PHP_EOL;
        }
        curl_close($ch);

        return array_merge(['httpCode' => $httpcode], $result);
    }

    /**
     * @param $jwt
     * @param $payload
     * @return array
     */
    public function calculateParcels($jwt, $payload)
    {
        $params = urldecode(http_build_query($payload));
        $url = "{$this->host}/api/v1/parcels?{$params}";
        $authorization = "Authorization: Bearer {$jwt}";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($response, $headerSize);
        $result = json_decode($body, true);

        if (curl_errno($ch)) {
            echo 'Library error: ' . curl_error($ch) . PHP_EOL;
        }
        curl_close($ch);

        return array_merge(['httpCode' => $httpcode], $result);
    }

    /**
     * @param $jwt
     * @param $parcelID
     * @return array
     */
    public function deteleParcel($jwt, $parcelID)
    {
        $url = "{$this->host}/api/v1/parcels/{$parcelID}";
        $authorization = "Authorization: Bearer {$jwt}";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'delete');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($response, $headerSize);
        $result = json_decode($body, true);

        if (curl_errno($ch)) {
            echo 'Library error: ' . curl_error($ch) . PHP_EOL;
        }
        curl_close($ch);

        return array_merge(['httpCode' => $httpcode], $result);
    }
}
