<?php

namespace App\Http\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

/**
 * Chiptuning API service
 *
 * Class ChiptuningClient
 * @package App\Http\Client
 */
class ChiptuningClient
{
    /**
     * Guzzle object
     *
     * @var Client $client
     */
    public $client;

    /**
     * API token
     *
     * @var $token
     */
    protected $token;

    /**
     * ChiptuningClient constructor.
     *
     * @param $url
     * @param $token
     */
    public function __construct($url, $token)
    {
        $this->client = new Client([
            'base_uri' => $url
        ]);
        $this->token = $token;
    }

    /**
     * Get the brands
     *
     * @return Collection|null
     * @throws GuzzleException
     */
    public function getBrands()
    {
        $response = $this->client->get('makes', $this->getOptions());
        if($response->getStatusCode() == 200)
        {
            $content = $response->getBody()->getContents();
            $content = json_decode($content);
            return collect($content->data);
        }

        return null;
    }

    /**
     * Get the models
     *
     * @param $brand
     * @return Collection|null
     * @throws GuzzleException
     */
    public function getModels($brand)
    {
        try {
            $response = $this->client->get("object-by-url/{$brand}", $this->getOptions());
            if($response->getStatusCode() == 200)
            {
                $content = $response->getBody()->getContents();
                $content = json_decode($content);
                return collect($content->meta->models);
            }
        } catch (\Exception $e) {
            report($e);
        }

        return null;
    }

    /**
     * Get the generations
     *
     * @param $brand
     * @param $model
     * @return Collection|null
     * @throws GuzzleException
     */
    public function getGenerations($brand, $model)
    {
        try{
            $response = $this->client->get("object-by-url/{$brand}/{$model}", $this->getOptions());
            if($response->getStatusCode() == 200)
            {
                $content = $response->getBody()->getContents();
                $content = json_decode($content);
                return collect($content->meta->generations);
            }
        } catch (\Exception $e) {
            report($e);
        }

        return null;
    }

    /**
     * Get the motor types
     *
     * @param $brand
     * @param $model
     * @param $generation
     * @return Collection|null
     * @throws GuzzleException
     */
    public function getMotortypes($brand, $model, $generation)
    {
        try {
            $response = $this->client->get("object-by-url/{$brand}/{$model}/{$generation}", $this->getOptions());
            if($response->getStatusCode() == 200)
            {
                $content = $response->getBody()->getContents();
                $content = json_decode($content);
                return collect($content->meta->engines);
            }
        } catch (\Exception $e) {
            report($e);
        }

        return null;
    }

    /**
     * Get details of object
     *
     * @param $brand
     * @param $model
     * @param $generation
     * @param $engine
     * @return mixed|null
     * @throws GuzzleException
     */
    public function getDetails($brand, $model, $generation, $engine)
    {
        $values = get_defined_vars();
        $url = $this->makeUrl($values);

        try {
            $response = $this->client->get($url, $this->getOptions());
            if($response->getStatusCode() == 200)
            {
                $content = $response->getBody()->getContents();
                $content = json_decode($content);
                return $content;
            }
        } catch (\Exception $e) {
           report($e);
        }

        return null;
    }

    /**
     * Get the request options
     *
     * @return \string[][]
     */
    public function getOptions()
    {
        return [
            'headers' => [
                'Authorization' => "Bearer {$this->token}",
                'Accept' => 'application/json'
            ],
            'query' => [
                'power_type' => 'pk'
            ]
        ];
    }

    /**
     * Build the url for the details
     *
     * @param $values
     * @return string
     */
    public function makeUrl($values)
    {
        $url = "/v1/object-by-url/";
        foreach ($values as $value)
        {
            if($value != null) {
                $url .= "{$value}/";
            }
        }

        return $url;
    }
}
