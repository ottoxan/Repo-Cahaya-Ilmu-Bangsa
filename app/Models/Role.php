<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $connection = 'loa';

    public function save(array $options = [])
    {
        throw new \Exception('Model Role is read-only in Repository.');
    }

    public function delete()
    {
        throw new \Exception('Model Role is read-only in Repository.');
    }
}
