<?php

namespace App\Traits;

trait Archivable
{
    public function archive()
    {
        $this->archived = true;
        $this->save();
    }

    public function unarchive()
    {
        $this->archived = false;
        $this->save();
    }

    public function isArchived()
    {
        return $this->archived;
    }

    public static function archived()
    {
        return static::where('archived', true);
    }

    public static function notArchived()
    {
        return static::where('archived', false);
    }
}
