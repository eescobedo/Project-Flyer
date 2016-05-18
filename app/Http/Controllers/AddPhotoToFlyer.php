<?php namespace App\Http\Controllers;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddPhotoToFlyer
{
    /**
     * @var \App\Builder
     */
    private $flyer;
    /**
     * @var array|null|\Symfony\Component\HttpFoundation\File\UploadedFile
     */
    private $photo;

    /**
     * AddPhotoToFlyer constructor.
     * @param \App\Builder|Flyer $flyer
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $photo
     */
    public function __construct(Flyer $flyer, UploadedFile $photo)
    {
        $this->flyer = $flyer;
        $this->photo = $photo;
    }

    public function save()
    {
        // Attach the photo to the flyer

        // move the photo to the images folder

        // generate a thumbnail
    }

}