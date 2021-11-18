<?php

namespace App\Interfaces;

use App\Classes\Weather;
use App\Classes\City;

interface WeatherApiInterface
{

    /**
     * This method connect with API and get content
     * @param string $keyApi
     * @param City
     * @var $apiKey
     *
     */
    function fetchStock(\App\Classes\City $city);

    /**
     * Get weather object with information about weather in City
     * @param \App\Classes\City $city
     * @return Weather
     */
//    public function getWeatherInformation(City $city): Weather;
    public function getWeatherInformation(City $city);
}