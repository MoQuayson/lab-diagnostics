<?php

namespace App\Models;

use App\Helpers\UsesUUID;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    //use UsesUUID;

    const ADMIN = "admin";
}
