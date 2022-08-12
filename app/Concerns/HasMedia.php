<?php

namespace App\Concerns;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

trait HasMedia
{

    public function setThumbnailAttribute(?string $value = null)
    {
        $attribute_name = "thumbnail";
        // or use your own disk, defined in config/filesystems.php
        $disk = config('backpack.base.root_disk_name');
        // destination path relative to the disk above
        $destination_path = "public/uploads";

        // if the image was erased
        if ($value == null && array_key_exists($attribute_name, $this->attributes)) {
            try {
                // delete the image from disk
                Storage::disk($disk)->delete($this->{$attribute_name});
            } catch (\Throwable $th) {
            }

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if ($value !== null && Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            $image = Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value . time()) . '.jpg';

            // 2. Store the image on disk.
            Storage::disk($disk)->put($destination_path . '/' . $filename, $image->stream());

            // 3. Delete the previous image, if there was one.
            if ($this->attribute_name) {
                Storage::disk($disk)->delete($this->{$attribute_name});
            }

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path . '/' . $filename;
        }
    }

    public function getThumbnailAttribute($thumbnail)
    {
        return !is_null($thumbnail) ? $thumbnail : 'assets/brand.png';
    }
}