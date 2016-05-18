<?php namespace App\Http\Controllers;

use App\Flyer;
use App\Http\Requests\AddPhotoRequest;
use App\Photo;
//use Illuminate\Http\Request;

use App\Http\Requests;

class PhotosController extends Controller
{
    /**
     * Apply a photo to the referenced flyer.
     *
     * @param string $zip
     * @param string $street
     * @param AddPhotoRequest $request
     *
     * @return string
     */
    public function store($zip, $street, AddPhotoRequest $request)
    {
//        $photo = Photo::fromFile($request->file('photo'));
//
//        Flyer::locatedAt($zip, $street)->addPhoto($photo);

        $flyer = Flyer::locatedAt($zip, $street);
        $photo = $request->file('photo');

        (new AddPhotoToFlyer($flyer, $photo))->save();

    }
}
