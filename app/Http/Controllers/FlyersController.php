<?php

namespace App\Http\Controllers;

//use App\Http\Requests\FlyerRequest;
use App\Flyer;
use App\Http\Flash;
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
        //flash()->success('Hello World', 'The is the message.');
        //flash()->overlay('Welcome aboard', 'Thank you for signing up.');
        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage..gitignore
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
        //session()->flash('flash_message', 'Flyer successfully created!');

        //flash('Success!', 'Your flyer has been created!', 'success');
        flash()->success('Success!', 'Your flyer has been created!');

        // redirect to landing page
        //temporary
        return redirect()->back();
    }

    public function addPhoto()
    {
        return 'Working on it';
    }


    /**
     * Display the specified resource.
     *
     * @param $zip
     * @param $street
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt ($zip, $street)->first();

        return view('flyers.show', compact('flyer'));
    }
}
