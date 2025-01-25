<?php

namespace App\Services;

use App\Repositories\CityRepository;

class CityService
{
    private CityRepository $cityRepository;

    public function __construct()
    {
        $this->cityRepository = new CityRepository();
    }

    public function getFormatedCities(): array
    {
        $cities = $this->cityRepository->getAllCities();
        $formatedCities = [];
        
        foreach ($cities as $city)
        {
            $formatedName = ucfirst(strtolower($city["value"]));
            $formatedCities[] = ['id'=>$city['id'], 'name'=>$formatedName];
        }
        return $formatedCities;
    }
}