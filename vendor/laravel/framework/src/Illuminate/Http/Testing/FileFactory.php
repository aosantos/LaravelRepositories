<?php

namespace Illuminate\Http\Testing;

<<<<<<< HEAD
use Illuminate\Support\Str;

=======
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
class FileFactory
{
    /**
     * Create a new fake file.
     *
     * @param  string  $name
     * @param  string|int  $kilobytes
     * @param  string|null  $mimeType
     * @return \Illuminate\Http\Testing\File
     */
    public function create($name, $kilobytes = 0, $mimeType = null)
    {
        if (is_string($kilobytes)) {
            return $this->createWithContent($name, $kilobytes);
        }

        return tap(new File($name, tmpfile()), function ($file) use ($kilobytes, $mimeType) {
            $file->sizeToReport = $kilobytes * 1024;
            $file->mimeTypeToReport = $mimeType;
        });
    }

    /**
     * Create a new fake file with content.
     *
     * @param  string  $name
     * @param  string  $content
     * @return \Illuminate\Http\Testing\File
     */
    public function createWithContent($name, $content)
    {
        $tmpfile = tmpfile();

        fwrite($tmpfile, $content);

        return tap(new File($name, $tmpfile), function ($file) use ($tmpfile) {
            $file->sizeToReport = fstat($tmpfile)['size'];
        });
    }

    /**
     * Create a new fake image.
     *
     * @param  string  $name
     * @param  int  $width
     * @param  int  $height
     * @return \Illuminate\Http\Testing\File
     */
    public function image($name, $width = 10, $height = 10)
    {
        return new File($name, $this->generateImage(
<<<<<<< HEAD
            $width, $height, Str::endsWith(Str::lower($name), ['.jpg', '.jpeg']) ? 'jpeg' : 'png'
=======
            $width, $height, pathinfo($name, PATHINFO_EXTENSION)
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd
        ));
    }

    /**
     * Generate a dummy image of the given width and height.
     *
     * @param  int  $width
     * @param  int  $height
<<<<<<< HEAD
     * @param  string  $type
     * @return resource
     */
    protected function generateImage($width, $height, $type)
    {
        return tap(tmpfile(), function ($temp) use ($width, $height, $type) {
            ob_start();

            $image = imagecreatetruecolor($width, $height);

            switch ($type) {
                case 'jpeg':
                    imagejpeg($image);
                    break;
                case 'png':
                    imagepng($image);
                    break;
            }
=======
     * @param  string  $extension
     * @return resource
     */
    protected function generateImage($width, $height, $extension)
    {
        return tap(tmpfile(), function ($temp) use ($width, $height, $extension) {
            ob_start();

            $extension = in_array($extension, ['jpeg', 'png', 'gif', 'webp', 'wbmp', 'bmp'])
                ? strtolower($extension)
                : 'jpeg';

            $image = imagecreatetruecolor($width, $height);

            call_user_func("image{$extension}", $image);
>>>>>>> 257505fe7f385dddbd7a37ea6158c5bc619eb0cd

            fwrite($temp, ob_get_clean());
        });
    }
}
