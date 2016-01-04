<?php

namespace App\Http\Controllers;

//use App\Http\Requests\FlyerRequest;
use App\Flyer;
use App\Http\Requests\FlyerRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FlyersController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @param FlyerRequest $request
     * @return \Response
     */
    public function store(FlyerRequest $request)
    {
        // validate the form
        // $this->validate(); Lo realiza el request
        // persist the flyer
        Flyer::create($request->all());

        // flash messaging

        // redirect to landing page
        //temporary
        return redirect()->back();

    }
}
