<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\Companies;
use App\Models\Employees;
use App\Models\Permissions;
use App\Models\User;
use App\Mail\SendCompanyEmail;
use Hash;
use DB;
use Auth;

class ActionController extends Controller
{
    

    public function addCompany(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|min:5|email|unique:users',
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_width=100,min_height=100'
        ]);

        if($request->hasFile('clogo')) {
            $logo = $request->file('clogo');
            $fileName = time() . '.' . $logo->getClientOriginalExtension();
            $request['logo'] = $fileName;
            $logo->storeAs('public', $fileName);
        }

        try {
            DB::beginTransaction();

            $request['password'] = Hash::make('password');
            $request['usertype'] = 'company';
            $user = User::create($request->except('logo', '_token', 'website', 'clogo'));
            $request['user_id'] = $user->id;
            $request['created_by'] = Auth::user() ? Auth::user()->id : 0;
            $data = Companies::create($request->except('_token', 'password', 'clogo', 'usertype'));
            
            Mail::to($request->email)->send(new SendCompanyEmail($data->name));

            DB::commit();
            return redirect()->back()->with('flash_message', 'Successfully added <strong>['.$request->name.']</strong> as company.');
        } catch (\Exception $th) {
            DB::rollback();
            dd($th->getMessage());
        }

    }
    
    
    public function editCompany(Request $request)
    {
        $request->validate([
            'ename' => 'required|min:5',
            'eemail' => 'required|min:5|email',
            'elogo' => 'image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_width=100,min_height=100'
        ]);

        if($request->hasFile('eclogo')) {
            $logo = $request->file('eclogo');
            $fileName = time() . '.' . $logo->getClientOriginalExtension();
            $request['logo'] = $fileName;
            $logo->storeAs('public', $fileName);
        }

        if($id = $request->eid) {
            try {
                DB::beginTransaction();

                $company = Companies::find($id);
                $user = User::find($company->user_id)->update(['name' => $request->ename,'email' => $request->eemail]);
                $update = [
                    'name' => $request->ename,
                    'email' => $request->eemail,
                    'website' => $request->ewebsite
                ];
                if($request->logo) $update['logo'] = $request->logo;
                $company->update($update);

                DB::commit();
                return redirect()->back()->with('flash_message', 'Successfully modified <strong>['.$request->ename.']</strong> company.');
            } catch (\Exception $th) {
                DB::rollback();
                dd($th->getMessage());
            }
        }
        else
            return redirect()->back()->withErrors(['Misssing ID parameter'])->withInput($request->all());
    }


    public function deleteCompany(Request $request, $id=null)
    {
        if($id) {
            try {
                DB::beginTransaction();
                $company = Companies::find($id);
                User::find($company->user_id)->delete();
                $name = $company->name;
                $logo = $company->logo;
                if(Storage::exists('public/'.$logo)) Storage::delete('public/'.$logo);
                $company->delete();
                DB::commit();
                return redirect()->back()->with('flash_message', 'Successfully deleted <strong>['.$name.']</strong> company.');
            } catch (\Throwable $th) {
                DB::rollback();
                dd($th->getMessage());
            }
        }
    }
    
    
    // ------------------------- Employee Management -------------------------------
    public function addEmployees(Request $request)
    {
        $request->validate([
            'firstname' => 'required|min:5',
            'lastname' => 'required|min:5',
            'company' => 'required|numeric',
            'email' => 'required|min:5|email|unique:users'
        ]);

        try {
            DB::beginTransaction();

            $request['password'] = Hash::make('password');
            $request['name'] = $request->lastname.' '.$request->firstname;
            $request['usertype'] = 'employee';
            $user = User::create($request->except('_token', 'company', 'firstname', 'lastname', 'phone'));
            $request['user_id'] = $user->id;
            $request['created_by'] = Auth::user() ? Auth::user()->id : 0;
            Employees::create($request->except('_token', 'password', 'name', 'usertype'));
            
            DB::commit();
            return redirect()->back()->with('flash_message', 'Successfully added <strong>['.$request->name.']</strong> as an employee.');
        } catch (\Exception $th) {
            DB::rollback();
            dd($th->getMessage());
        }

    }
    
    
    public function editEmployees(Request $request)
    {
        $request->validate([
            'efirstname' => 'required|min:5',
            'elastname' => 'required|min:5',
            'eemail' => 'required|min:5|email',
            'ecompany' => 'required|numeric'
        ]);

        if($id = $request->eid) {
            try {
                DB::beginTransaction();

                $employee = Employees::find($id);
                $name = $request->elastname.' '.$request->efirstname;
                $user = User::find($employee->user_id)->update(['name' => $name,'email' => $request->eemail]);
                $update = [
                    'firstname' => $request->efirstname,
                    'lastname' => $request->elastname,
                    'email' => $request->eemail,
                    'phone' => $request->ephone,
                    'company' => $request->ecompany,
                ];
                $employee->update($update);

                DB::commit();
                return redirect()->back()->with('flash_message', 'Successfully modified <strong>['.$name.']</strong> information.');
            } catch (\Exception $th) {
                DB::rollback();
                dd($th->getMessage());
            }
        }
        else
            return redirect()->back()->withErrors(['Misssing ID parameter'])->withInput($request->all());
    }


    public function deleteEmployees(Request $request, $id=null)
    {
        if($id) {
            try {
                DB::beginTransaction();
                $employee = Employees::find($id);
                User::find($employee->user_id)->delete();
                $name = $employee->lastname.' '.$employee->firstname;
                $employee->delete();
                DB::commit();
                return redirect()->back()->with('flash_message', 'Successfully deleted <strong>['.$name.']</strong> as an employee.');
            } catch (\Throwable $th) {
                DB::rollback();
                dd($th->getMessage());
            }
        }
    }



    // ------------------------- Admin Management -------------------------------
    public function addAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|min:5|email|unique:users'
        ]);

        try {
            DB::beginTransaction();

            $request['password'] = Hash::make('password');
            $request['usertype'] = 'admin';
            User::create($request->except('_token'));
            DB::commit();
            return redirect()->back()->with('flash_message', 'Successfully added <strong>['.$request->name.']</strong> as an admin.');
        } catch (\Exception $th) {
            DB::rollback();
            dd($th->getMessage());
        }
    }


    public function deleteAdmin(Request $request, $id=null)
    {
        if($id) {
            try {
                DB::beginTransaction();
                $user = User::find($id);
                $name = $user->name;
                $user->delete();
                DB::commit();
                return redirect()->back()->with('flash_message', 'Successfully deleted <strong>['.$name.']</strong> as an admin.');
            } catch (\Throwable $th) {
                DB::rollback();
                dd($th->getMessage());
            }
        }
    }



    // ------------------------- Permission Management -------------------------------
    public function addPermissions(Request $request)
    {
        $slugs = $request->slug;
        $usertypes = $request->usertype;
        $grants = $request->grants;

        if(isset($grants) && is_array($grants)) {
            DB::beginTransaction();
            Permissions::truncate();
            foreach($slugs as $key => $slug) {
                if(isset($usertypes[$key]) && is_array($usertypes[$key])) {
                    foreach($usertypes[$key] as $ikey => $usertype) {
                        $grant = '';
                        if((isset($grants[$key]) && is_array($grants[$key])) && (isset($grants[$key][$ikey]) && is_array($grants[$key][$ikey])))
                            $grant = implode(',', $grants[$key][$ikey]);
                        Permissions::create([
                            'slug' => $slug,
                            'usertype' => $usertype,
                            'grants' => $grant
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->back()->with('flash_message', 'Successfully granted permission.');
        }
        else {
            return redirect()->back()->withErrors(['Kindly select the permissions to be granted.']);
        }
    }
}
