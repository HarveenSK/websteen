<?php

namespace App\Http\Controllers;

use App\Http\Client\ChiptuningClient;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class ChiptuningDetailController
 * @package App\Http\Controllers
 */
class ChiptuningDetailController extends Controller
{

    /**
     * API interface.
     *
     * @var Application|mixed
     */
    public $chiptuning;

    /**
     * ChiptuningDetailController constructor.
     */
    public function __construct()
    {
        $this->chiptuning = resolve(ChiptuningClient::class);
    }

    /**
     * Get the details
     *
     * @param $brand
     * @param null $model
     * @param null $generation
     * @param null $motortype
     * @return Application|Factory|View|RedirectResponse
     */
    public function index($brand, $model = null, $generation = null, $motortype = null)
    {
        $countParams = count(array_filter(get_defined_vars()));

        switch ($countParams)
        {
            case 1:
                $options = $this->chiptuning->getModels($brand);
                if($options == null) {
                    return redirect()->back()->withErrors(['brand' => 'Brand name icorrect']);
                }
                $view = view('pages.home', ['models' => $options, 'header' => 'Kies uw model']);
            break;
            case 2:
                $options = $this->chiptuning->getGenerations($brand, $model);
                if($options == null) {
                    return redirect()->back()->withErrors(['brand' => 'Model name icorrect']);
                }
                $view = view('pages.home', ['generations' => $options, 'header' => 'Kies de generatie']);
            break;
            case 3:
                $options = $this->chiptuning->getMotortypes($brand, $model, $generation);
                if($options == null) {
                    return redirect()->back()->withErrors(['brand' => 'Generation type incorrect']);
                }
                $view = view('pages.home', ['motortypes' => $options, 'header' => 'Kies de motortype']);
            break;
            case 4:
                $detail = $this->chiptuning->getDetails($brand, $model, $generation, $motortype);
                if($detail == null) {
                    return redirect()->back()->withErrors(['brand' => 'Motor type incorrect']);
                }
                $view = view('pages.detail', ['detail' => $detail]);
            break;
            default:
                $brands = $this->chiptuning->getBrands();
                $view = view('pages.home', ['brands' => $brands, 'header' => 'Kies uw merk']);
        }

        return $view;
    }
}
