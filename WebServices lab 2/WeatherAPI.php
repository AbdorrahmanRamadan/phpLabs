<?php
const API_KEY = 'ce95ea69b2f01da5d85a42d96a350308';
require_once "vendor\autoload.php";
use GuzzleHttp\Client;
class WeatherAPI
{

    public static function get_cities($countryToSearch)
    {
        $str = file_get_contents(__DIR__ . '/city-list.json');
        $json = json_decode($str, true);
        $cities = [];
        foreach ($json as $city) {
            if (strtolower($city['country']) === $countryToSearch) {
                $cities[] = $city;
            }
        }
        return $cities;
    }

    public static function get_weather($lat, $lon)
    {
        try {
            $url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=" . API_KEY."&units=metric";
            $client = new Client();
            $response = $client->get($url);
            return json_decode($response->getBody());
        } catch (Exception $exception) {
            return json_encode([
                'status' => 501,
                'message' => "Gateway Error"
            ]);
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
        }
    }
}