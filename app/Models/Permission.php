<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $connection = 'loa';

    public function save(array $options = [])
    {
        throw new \Exception('Model Permission is read-only in Repository.');
    }

    public function delete()
    {
        throw new \Exception('Model Permission is read-only in Repository.');
    }
}
