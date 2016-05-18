<?php namespace App\Http\Controllers;

use App\Flyer;
//use App\Photo;
use App\Http\Requests;
use App\Http\Requests\FlyerRequest;
//use App\Http\Requests\AddPhotoRequest;

class FlyersController extends Controller
{
    /**
     * Create a new FlyersController instance.
     */
    public function __construct()
    {
        // Realiza la validación que el usuario este logueado en para usar este controlador,
        // con except, se le indica que no haga esa validacion en el metodo show
        $this->middleware('auth', ['except' => ['show']]);

        parent::__construct();
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage..gitignore
     *
     *
     * @param FlyerRequest $request
     *
     * @return \Response
     */
    public function store(FlyerRequest $request)
    {
//        Flyer::create($request->all());

        $flyer = $this->user->publish(
            new Flyer($request->all())
        );

        flash()->success('Success!', 'Your flyer has been created!');

        // redirect to landing page
//        return redirect()->back();
//        return redirect()->route('flyer_path', [$flyer->zip, $flyer->address]);
//        return redirect($flyer->zip . '/' . str_replace(' ', '-', $flyer->address));
//        return redirect($flyer->path());
        return redirect(flyer_path($flyer));
    }

//    /**
//     * Apply a photo to the referenced flyer.
//     *
//     * @param string $zip
//     * @param string $street
//     * @param AddPhotoRequest $request
//     *
//     * @return string
//     */
//    public function addPhoto($zip, $street, AddPhotoRequest $request)
//    {
//        $photo = Photo::fromFile($request->file('photo'));
//
//        Flyer::locatedAt($zip, $street)->addPhoto($photo);
//    }

    /**
     * Display the specified resource.
     *
     * @param $zip
     * @param $street
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }
}
