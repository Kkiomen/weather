<?php


namespace App\Api;


use App\Classes\Weather;
use App\Entity\City;
use App\Interfaces\WeatherApiInterface;
use Symfony\Component\HttpClient\HttpClient;


class OpenWeatherMapApi implements WeatherApiInterface
{

    private const URL = 'http://api.openweathermap.org/data/2.5/weather';
    private $apiKey;


    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     */
    function fetchStock(City $city)
    {
        try{
            $client = HttpClient::create();
            $response = $client->request('GET', self::URL,[
                'query' => [
                    'q' => $city->getName(),
                    'APPID' => $this->apiKey,
                    'units' => 'metric' // For temperature in Celsius
                ]
            ]);
            return [
                'status' => $response->getStatusCode(),
                'content' => $response->toArray()
            ];
        }catch (\Exception  $e){
            return [
                'status' => 401,
                'content' => 'No results found'
            ];
        }

    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     */
    public function getWeatherInformation(City $city)
    {
        $response = $this->fetchStock($city);

        if($response['status'] == 401){
            return null;
        }else{
            $content = $response['content'];
            $weather = new Weather();
            $weather->setName($content['weather'][0]['main']);
            $weather->setDescription($content['weather'][0]['description']);
            $weather->setIcon($content['weather'][0]['icon']);
            $weather->setHumidity($content['main']['humidity']);
            $weather->setPressure($content['main']['pressure']);
            $weather->setTemperature($content['main']['temp']);
            $weather->setTemperatureFeelsLike($content['main']['feels_like']);
            $weather->setTemperatureMin($content['main']['temp_min']);
            $weather->setTemperatureMax($content['main']['temp_max']);
            $weather->setWindSpeed($content['wind']['speed']);
            return $weather;
        }

    }

}