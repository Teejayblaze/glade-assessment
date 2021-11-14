<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Companies;
use App\Models\Employees;
use App\Models\Permissions;
use App\Models\User;
use Auth;

class PagesController extends Controller
{
    private $data;

    public function __construct()
    {
        $this->data = [];
    }


    public function companies(Request $request)
    {
        $this->data['title'] = 'Companies';
        $this->data['corefile'] = 'core.companies';
        $where = [];

        $user = Auth::user();
        if($user->usertype == 'company') $where['user_id'] = $user->id;
        if($user->usertype == 'employee') $where['id'] = Employees::where('user_id', $user->id)->first()->company;
        
        $this->data['companies'] = Companies::where($where)->orderBy('created_at', 'DESC')->paginate(10);
        return view('tpl.main', $this->data);
    }
    
    
    public function employees(Request $request)
    {
        $this->data['title'] = 'Employees';
        $this->data['corefile'] = 'core.employees';

        $cwhere = $ewhere = [];
        $user = Auth::user();
        if($user->usertype == 'company') {
            $cwhere['user_id'] = $user->id;
            $ewhere['company'] = $user->companyRelation->id;
        }
        if($user->usertype == 'employee') {
            $cwhere['id'] = Employees::where('user_id', $user->id)->first()->company;
            $ewhere['company'] = $cwhere['id'];
        }

        $this->data['companies'] = Companies::where($cwhere)->orderBy('created_at', 'DESC')->get();
        $this->data['employees'] = Employees::where($ewhere)->orderBy('created_at', 'DESC')->paginate(10);
        return view('tpl.main', $this->data);
    }


    public function admins(Request $request)
    {
        $this->data['title'] = 'Admins';
        $this->data['corefile'] = 'core.admins';
        $this->data['admins'] = User::where('usertype', 'admin')->orderBy('created_at', 'DESC')->paginate(10);
        return view('tpl.main', $this->data);
    }
    
    
    public function permissions(Request $request)
    {
        $this->data['title'] = 'Permissions';
        $this->data['corefile'] = 'core.permissions';
        $permissions = Permissions::all();
        $data = [];
        foreach ($permissions as $key => $perm) {
            if(!isset($data[$perm->slug]))
                $data[$perm->slug] = [$perm->usertype => explode(',', $perm->grants)];
            if(isset($data[$perm->slug]) && !isset($data[$perm->slug][$perm->usertype]))
                $data[$perm->slug][$perm->usertype] = explode(',', $perm->grants);
        }
        $this->data['perm'] = $data;
        return view('tpl.main', $this->data);
    }
}
