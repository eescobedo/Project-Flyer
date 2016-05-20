<?php namespace App\Http\Controllers;

use App\Flyer;
use App\Http\Thumbnail;
use App\Photo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class AddPhotoToFlyer
{
    /**
     * @var \App\Builder
     */
    private $flyer;
    /**
     * @var array|null|\Symfony\Component\HttpFoundation\File\UploadedFile
     */
    private $file;

    /**
     * AddPhotoToFlyer constructor.
     * @param \App\Builder|Flyer $flyer
     * @param UploadedFile $file
     * @param Thumbnail $thumbnail
     * @internal param UploadedFile $photo
     */
    public function __construct(Flyer $flyer, UploadedFile $file, Thumbnail $thumbnail = null)
    {
        $this->flyer = $flyer;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;
    }

    public function save()
    {
        // Attach the photo to the flyer

        $photo = $this->flyer->addPhoto($this->makePhoto());


        // move the photo to the images folder
        $this->file->move($photo->baseDir(), $photo->name);


//        Image::make($this->path)
//            ->fit(200)
//            ->save($this->thumbnail_path);

        // generate a thumbnail
        $this->thumbnail->make($photo->path, $photo->thumbnail_path);
    }

    protected function makePhoto()
    {
        return new Photo(['name' => $this->makeFileName()]);
    }

    public function makeFileName()
    {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";

    }

}