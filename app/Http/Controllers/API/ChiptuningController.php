<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandsResource;
use App\Http\Client\ChiptuningClient;
use App\Http\Resources\GenerationsResource;
use App\Http\Resources\ModelsResource;
use App\Http\Resources\MotortypesResource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

/**
 * Class ChiptuningController
 * @package App\Http\Controllers\API
 */
class ChiptuningController extends Controller
{

    /**
     * API interface.
     *
     * @var Application|mixed
     */
    public $chiptuning;

    /**
     * ChiptuningController constructor.
     */
    public function __construct()
    {
        $this->chiptuning = resolve(ChiptuningClient::class);
    }

    /**
     * Get the brands.
     *
     * @return BrandsResource|JsonResponse
     */
    public function brands()
    {
        $brands = $this->chiptuning->getBrands();
        if($brands) {
            return new BrandsResource($brands);
        }
        return response::json(['message' => 'Brands not found'], 404, );
    }

    /**
     * Get the models.
     *
     * @param $brand
     * @return ModelsResource|JsonResponse
     */
    public function models($brand)
    {
        $models = $this->chiptuning->getModels($brand);
        if($models) {
            return new ModelsResource($models);
        }

        return response::json(['message' => 'Models not found'], 404, );
    }

    /**
     * Get the generations.
     *
     * @param $brand
     * @param $model
     * @return GenerationsResource|JsonResponse
     */
    public function generations($brand, $model)
    {
        $generations = $this->chiptuning->getGenerations($brand, $model);
        if($generations) {
            return new GenerationsResource($generations);
        }

        return response::json(['message' => 'Generations not found'], 404, );
    }

    /**
     * Get the motor types.
     *
     * @param $brand
     * @param $model
     * @param $generation
     * @return MotortypesResource|JsonResponse
     */
    public function motortypes($brand, $model, $generation)
    {
        $generations = $this->chiptuning->getMotortypes($brand, $model ,$generation);
        if($generations) {
            return new MotortypesResource($generations);
        }

        return response::json(['message' => 'Motor types not found'], 404, );
    }
}
