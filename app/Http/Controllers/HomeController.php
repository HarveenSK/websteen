<?php

namespace App\Http\Controllers;

use App\Http\Client\ChiptuningClient;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Redirect to home page.
     *
     * @return RedirectResponse
     */
    public function index()
    {
        return redirect()->route('index.show');
    }

    /**
     * Display the home page.
     *
     * @return Application|Factory|View
     */
    public function show()
    {
        $chiptuningClient = resolve(ChiptuningClient::class);
        $brands = $chiptuningClient->getBrands();
        return view('pages.home', ['brands' => $brands, 'header' => 'Kies uw merk']);
    }


}
