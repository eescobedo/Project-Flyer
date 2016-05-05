<?php namespace App\Http\Controllers;

//use App\Http\Requests\FlyerRequest;
use App\Flyer;
use App\Http\Flash;
use App\Http\Requests\FlyerRequest;
use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;

class FlyersController extends Controller
{
    /**
     * FlyersController constructor.
     */
    public function __construct()
    {
        // Realiza la validación que el usuario este logueado en para usar este controlador,
        // con except, se le indica que no haga esa validacion en el metodo show
        $this->middleware('auth', ['except' => ['show']]);
    }


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
        return redirect()->back();
    }

    /**
     * Apply a photo to the referenced flyer.
     * @param string $zip
     * @param string $street
     * @param Request $request
     * @return string
     */
    public function addPhoto($zip, $street, Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        $photo = $this->makePhoto($request->file('photo'));

        $flyer = Flyer::locatedAt($zip, $street)->addPhoto($photo);

//        return 'done';
    }

    public function makePhoto(UploadedFile $file)
    {
//        return Photo::fromForm($file)->store($file);
        return Photo::named($file->getClientOriginalName())
            ->move($file);
    }

    /**
     * Display the specified resource.
     *
     * @param $zip
     * @param $street
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }
}
