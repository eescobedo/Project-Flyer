<?php namespace App;

use Illuminate\Support\Facades\File;
use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    /**
     * The associated table.
     * @var string
     */
    protected $table = 'flyer_photos';

    /**
     * Fillable fields for a photo.
     *
     * @var array
     */
    protected $fillable = ['path', 'name', 'thumbnail_path'];

    protected $file;

//    protected static function boot()
//    {
//        static::creating(function ($photo) {
//            return $photo->upload();
//        });
//    }

    /**
     * A photo belongs to a flyer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

//    /**
//     * Make a new photo instance from an uploaded file
//     *
//     * @param UploadedFile $file
//     * @return self
//     */
//    public static function fromFile(UploadedFile $file)
//    {
//        $photo = new static;
//
//        $photo->file = $file;
//
////        return $photo->fill([
////            'name' => $photo->fileName(),
////            'path' => $photo->filePath(),
////            'thumbnail_path' => $photo->thumbnailPath()
////        ]);
//    }

    /**
     * Get the file name for the photo
     *
     * @return string
     */
    public function fileName()
    {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name; // $photo->name = 'new.jpg'

        $this->path = $this->baseDir() .'/' . $name;
        $this->thumbnail_path = $this->baseDir() .'/tn-' . $name;
    }


//    /**
//     * Get the path to the photo.
//     *
//     * @return string
//     */
//    public function filePath()
//    {
//        return $this->baseDir() . '/' . $this->fileName();
//    }
//
//    /**
//     * Get the path to the photo's thumbnail.
//     *
//     * @return string
//     */
//    public function thumbnailPath()
//    {
//        return $this->baseDir() . '/tn-' . $this->fileName();
//    }

    /**
     * Get the base directory for photo uploads
     * 
     * @return string
     */
    public function baseDir()
    {
        return 'images/photos';
    }


    /**
     * Move the photo to the profer folder.
     *
     * @return self
     */
    public function upload()
    {
//        $this->file->move($this->baseDir(), $this->fileName());

        $this->makeThumbnail();

        return $this;

    }


    public function delete()
    {
        File::delete([
            $this->path,
            $this->thumbnail_path
        ]);

        parent::delete();
    }

//    /**
//     * Create a thumbnail for the photo.
//     *
//     * @return void
//     */
//    protected function makeThumbnail()
//    {
//        Image::make($this->filePath())
//            ->fit(200)
//            ->save($this->thumbnailPath());
//
//    }
}
