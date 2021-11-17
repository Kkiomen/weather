<?php

namespace App\Classes;

class Weather
{

    private $name = null;
    private $description = null;
    private $icon = null;
    private $temperature = null;
    private $temperatureFeelsLike = null;
    private $temperatureMin = null;
    private $temperatureMax = null;
    private $pressure = null;
    private $humidity = null;
    private $windSpeed = null;



    /**
     * @return null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return null
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Get url to image weather
     * @return string
     */
    public function getIconImageUrl(int $size)
    {
        return 'http://openweathermap.org/img/wn/'.$this->icon.'@'.$size.'x.png';
    }

    /**
     * @param null $icon
     */
    public function setIcon($icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @return null
     */
    public function getTemperature()
    {
        return round($this->temperature,1);
    }

    /**
     * @param null $temperature
     */
    public function setTemperature($temperature): void
    {
        $this->temperature = $temperature;
    }

    /**
     * @return null
     */
    public function getTemperatureFeelsLike()
    {
        return $this->temperatureFeelsLike;
    }

    /**
     * @param null $temperatureFeelsLike
     */
    public function setTemperatureFeelsLike($temperatureFeelsLike): void
    {
        $this->temperatureFeelsLike = $temperatureFeelsLike;
    }

    /**
     * @return null
     */
    public function getTemperatureMin()
    {
        return round($this->temperatureMin,1);
    }

    /**
     * @param null $temperatureMin
     */
    public function setTemperatureMin($temperatureMin): void
    {
        $this->temperatureMin = $temperatureMin;
    }

    /**
     * @return null
     */
    public function getTemperatureMax()
    {
        return round($this->temperatureMax,1);
    }

    /**
     * @param null $temperatureMax
     */
    public function setTemperatureMax($temperatureMax): void
    {
        $this->temperatureMax = $temperatureMax;
    }

    /**
     * @return null
     */
    public function getPressure()
    {
        return $this->pressure;
    }

    /**
     * @param null $pressure
     */
    public function setPressure($pressure): void
    {
        $this->pressure = $pressure;
    }

    /**
     * @return null
     */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * @param null $humidity
     */
    public function setHumidity($humidity): void
    {
        $this->humidity = $humidity;
    }

    /**
     * @return null
     */
    public function getWindSpeed()
    {
        return $this->windSpeed;
    }

    /**
     * @param null $windSpeed
     */
    public function setWindSpeed($windSpeed): void
    {
        $this->windSpeed = $windSpeed;
    }


}