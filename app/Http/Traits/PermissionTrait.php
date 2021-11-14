<?php 

namespace App\Http\Traits;
use App\Models\Permissions;

trait PermissionTrait {

    public function hasPermission($slug, $usertype, $perm)
    {
        if(empty($slug) || empty($usertype) || empty($perm)) return false;

        $permission = Permissions::where(['slug' => $slug, 'usertype' => $usertype])->first();
        if($permission) {
            if(!in_array($perm, explode(',', $permission->grants))) return false;
            else return true;
        }
        else return false;
    }
}