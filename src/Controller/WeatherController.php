<?php

namespace App\Controller;

use App\Api\OpenWeatherMapApi;
use App\Classes\Weather;
use App\Entity\City;
use App\Form\WeatherType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    /**
     * @Route("/weather", name="weather")
     */
    public function index(Request $request): Response
    {

        $city = new City();
        $form = $this->createForm(WeatherType::class, $city, [
            'action' => $this->generateUrl('weather_search')
        ]);

        if(!isset($_GET['error'])){
            $error = null;
        }else{
            $error = $_GET['error'];
        }

        return $this->render('weather/index.html.twig', [
            'controller_name' => 'WeatherController',
            'form_choose_city' => $form->createView(),
            'error' => $error
        ]);
    }

    /**
     * @Route("/weather/display/", name="weather_display_empty")
     */
    public function displayWeatherEmpty(){
        return $this->redirectToRoute('index',['error' => 'No results found']);
    }


    /**
     * @Route("/weather/display/{city}", name="weather_display")
     */
    public function displayWeather(Request $request, $city){

        $getWeather = new Weather();
        $weather = new OpenWeatherMapApi($this->getParameter('api_key.openweathermap'));
        $cityEntity = new City();
        $cityEntity->setName($city);
        $getWeather = $weather->getWeatherInformation($cityEntity);

        if(is_null($getWeather)){
            return $this->redirectToRoute('index',['error' => 'No results found']);
        }


        $form = $this->createForm(WeatherType::class, $cityEntity, [
            'action' => $this->generateUrl('weather_search')
        ]);

        return $this->render('weather/display.html.twig', [
            'weather' => $getWeather,
            'city' => $city,
            'form_choose_city' => $form->createView(),
        ]);
    }

    /**
     * @Route("/weather/search", name="weather_search")
     */
    public function formWeatherAction(Request $request){
        $city = new City();
        $form = $this->createForm(WeatherType::class, $city);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            if(!is_null($data->getName())){
                return $this->redirectToRoute('weather_display', ['city' => $data->getName()]);
            }else{
                $form->get('name')->addError(new FormError('This field cannot be empty'));
            }
        }
    }


}
