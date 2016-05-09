<?php namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $fillable = ['path', 'name', 'thumbnail_path'];

    protected $baseDir = 'images/photos';

    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    /**
     * Build a new photo instance from a file upload
     * @param string $name
     * @return self
     */
    public static function named($name)
    {
//        $photo = new static;
//        return $photo->saveAs($file->getClientOriginalName());

        return (new static)->saveAs($name);

//        $photo->path = $photo->baseDir . '/' . $name;
//        $file->move($photo->baseDir, $name);
//        return $photo;
    }

    protected function saveAs($name)
    {
        $this->name = sprintf("%s-%s", time(), $name);
        $this->path = sprintf("%s/%s", $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);

        return $this;
    }
    
    public function move(UploadedFile $file)
    {
        $file->move($this->baseDir, $this->name);

        $this->makeThumbnail();

        return $this;

    }

    protected function makeThumbnail()
    {
        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);

    }
}
