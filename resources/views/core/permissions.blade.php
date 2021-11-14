<style type="text/css">
    .list-none {
        list-style-type: none;
    }
</style>
<form action="{{url('add-permissions')}}" method="post">
@csrf
<div class="content-header row">
    <div class="content-header-left col-md-4 col-12 mb-2">
      <h3 class="content-header-title">{{ucwords($title)}}</h3>
    </div>
    <div class="content-header-right col-md-8 col-12">
      <div class="breadcrumbs-top float-md-right">
        <div class="breadcrumb-wrapper mr-1">
        @if (Auth::check() && Auth::user()->hasPermission('permissions', Auth::user()->usertype, 'create'))
          <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <button type="submit" class="btn btn-primary text-white btn-sm" data-toggle="modal" data-target="#add-employee"><i class="la la-save"></i> Save {{ucwords($title)}}</button></li>
          </ol>
        @endif
        </div>
      </div>
    </div>
  </div>
  <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ucwords($title)}}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    @if ($errors->any())
                    <ul class="alert alert-danger ml-2 mr-2 list-none" role="alert">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                    @if (\Session::has('flash_message'))
                        <div class="alert alert-success ml-2 mr-2">{!! \Session::get('flash_message') !!}</div>
                    @endif
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>Resources</th>
                                            <th colspan="6">Permission Grants</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Companies <input type="hidden" name="slug[companies]" value="companies"></th>
                                            <td colspan="6">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>User Types</th>
                                                                <th>Create</th>
                                                                <th>Read</th>
                                                                <th>Update</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Super Admin <input type="hidden" name="usertype[companies][super-admin]" value="super-admin"></td>
                                                                <td><input type="checkbox" name="grants[companies][super-admin][]" value="create" 
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['super-admin']) && is_array($perm['companies']['super-admin']) && in_array('create', $perm['companies']['super-admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[companies][super-admin][]" value="read"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['super-admin']) && is_array($perm['companies']['super-admin']) && in_array('read', $perm['companies']['super-admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[companies][super-admin][]" value="update"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['super-admin']) && is_array($perm['companies']['super-admin']) && in_array('update', $perm['companies']['super-admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[companies][super-admin][]" value="delete"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['super-admin']) && is_array($perm['companies']['super-admin']) && in_array('delete', $perm['companies']['super-admin'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Company <input type="hidden" name="usertype[companies][company]" value="company"></td>
                                                                <td><input type="checkbox" name="grants[companies][company][]" value="create"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['company']) && is_array($perm['companies']['company']) && in_array('create', $perm['companies']['company'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[companies][company][]" value="read"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['company']) && is_array($perm['companies']['company']) && in_array('read', $perm['companies']['company'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[companies][company][]" value="update"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['company']) && is_array($perm['companies']['company']) && in_array('update', $perm['companies']['company'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[companies][company][]" value="delete"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['company']) && is_array($perm['companies']['company']) && in_array('delete', $perm['companies']['company'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Employee <input type="hidden" name="usertype[companies][employee]" value="employee"></td>
                                                                <td><input type="checkbox" name="grants[companies][employee][]" value="create"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['employee']) && is_array($perm['companies']['employee']) && in_array('create', $perm['companies']['employee'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[companies][employee][]" value="read"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['employee']) && is_array($perm['companies']['employee']) && in_array('read', $perm['companies']['employee'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[companies][employee][]" value="update"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['employee']) && is_array($perm['companies']['employee']) && in_array('update', $perm['companies']['employee'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[companies][employee][]" value="delete"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['employee']) && is_array($perm['companies']['employee']) && in_array('delete', $perm['companies']['employee'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Admin <input type="hidden" name="usertype[companies][admin]" value="admin"></td>
                                                                <td><input type="checkbox" name="grants[companies][admin][]" value="create"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['admin']) && is_array($perm['companies']['admin']) && in_array('create', $perm['companies']['admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[companies][admin][]" value="read"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['admin']) && is_array($perm['companies']['admin']) && in_array('read', $perm['companies']['admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[companies][admin][]" value="update"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['admin']) && is_array($perm['companies']['admin']) && in_array('update', $perm['companies']['admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[companies][admin][]" value="delete"
                                                                    {{(isset($perm['companies']) && is_array($perm['companies']) && isset($perm['companies']['admin']) && is_array($perm['companies']['admin']) && in_array('delete', $perm['companies']['admin'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Employees <input type="hidden" name="slug[employees]" value="employees"></th>
                                            <td colspan="6">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>User Types</th>
                                                                <th>Create</th>
                                                                <th>Read</th>
                                                                <th>Update</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Super Admin <input type="hidden" name="usertype[employees][super-admin]" value="super-admin"></td>
                                                                <td><input type="checkbox" name="grants[employees][super-admin][]" value="create"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['super-admin']) && is_array($perm['employees']['super-admin']) && in_array('create', $perm['employees']['super-admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[employees][super-admin][]" value="read"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['super-admin']) && is_array($perm['employees']['super-admin']) && in_array('read', $perm['employees']['super-admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[employees][super-admin][]" value="update"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['super-admin']) && is_array($perm['employees']['super-admin']) && in_array('update', $perm['employees']['super-admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[employees][super-admin][]" value="delete"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['super-admin']) && is_array($perm['employees']['super-admin']) && in_array('delete', $perm['employees']['super-admin'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Company <input type="hidden" name="usertype[employees][company]" value="company"></td>
                                                                <td><input type="checkbox" name="grants[employees][company][]" value="create"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['company']) && is_array($perm['employees']['company']) && in_array('create', $perm['employees']['company'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[employees][company][]" value="read"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['company']) && is_array($perm['employees']['company']) && in_array('read', $perm['employees']['company'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[employees][company][]" value="update"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['company']) && is_array($perm['employees']['company']) && in_array('update', $perm['employees']['company'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[employees][company][]" value="delete"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['company']) && is_array($perm['employees']['company']) && in_array('delete', $perm['employees']['company'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Employees <input type="hidden" name="usertype[employees][employee]" value="employee"></td>
                                                                <td><input type="checkbox" name="grants[employees][employee][]" value="create"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['employee']) && is_array($perm['employees']['employee']) && in_array('create', $perm['employees']['employee'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[employees][employee][]" value="read"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['employee']) && is_array($perm['employees']['employee']) && in_array('read', $perm['employees']['employee'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[employees][employee][]" value="update"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['employee']) && is_array($perm['employees']['employee']) && in_array('update', $perm['employees']['employee'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[employees][employee][]" value="delete"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['employee']) && is_array($perm['employees']['employee']) && in_array('delete', $perm['employees']['employee'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Admin <input type="hidden" name="usertype[employees][admin]" value="admin"></td>
                                                                <td><input type="checkbox" name="grants[employees][admin][]" value="create"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['admin']) && is_array($perm['employees']['admin']) && in_array('create', $perm['employees']['admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[employees][admin][]" value="read"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['admin']) && is_array($perm['employees']['admin']) && in_array('read', $perm['employees']['admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[employees][admin][]" value="update"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['admin']) && is_array($perm['employees']['admin']) && in_array('update', $perm['employees']['admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[employees][admin][]" value="delete"
                                                                    {{(isset($perm['employees']) && is_array($perm['employees']) && isset($perm['employees']['admin']) && is_array($perm['employees']['admin']) && in_array('delete', $perm['employees']['admin'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Admins <input type="hidden" name="slug[admins]" value="admins"></th>
                                            <td colspan="6">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>User Types</th>
                                                                <th>Create</th>
                                                                <th>Read</th>
                                                                <th>Update</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Super Admin <input type="hidden" name="usertype[admins][super-admin]" value="super-admin"></td>
                                                                <td><input type="checkbox" name="grants[admins][super-admin][]" value="create"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['super-admin']) && is_array($perm['admins']['super-admin']) && in_array('create', $perm['admins']['super-admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[admins][super-admin][]" value="read"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['super-admin']) && is_array($perm['admins']['super-admin']) && in_array('read', $perm['admins']['super-admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[admins][super-admin][]" value="update"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['super-admin']) && is_array($perm['admins']['super-admin']) && in_array('update', $perm['admins']['super-admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[admins][super-admin][]" value="delete"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['super-admin']) && is_array($perm['admins']['super-admin']) && in_array('delete', $perm['admins']['super-admin'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Company <input type="hidden" name="usertype[admins][company]" value="company"></td>
                                                                <td><input type="checkbox" name="grants[admins][company][]" value="create"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['company']) && is_array($perm['admins']['company']) && in_array('create', $perm['admins']['company'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[admins][company][]" value="read"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['company']) && is_array($perm['admins']['company']) && in_array('read', $perm['admins']['company'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[admins][company][]" value="update"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['company']) && is_array($perm['admins']['company']) && in_array('update', $perm['admins']['company'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[admins][company][]" value="delete"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['company']) && is_array($perm['admins']['company']) && in_array('delete', $perm['admins']['company'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Employees <input type="hidden" name="usertype[admins][employee]" value="employee"></td>
                                                                <td><input type="checkbox" name="grants[admins][employee][]" value="create"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['employee']) && is_array($perm['admins']['employee']) && in_array('create', $perm['admins']['employee'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[admins][employee][]" value="read"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['employee']) && is_array($perm['admins']['employee']) && in_array('read', $perm['admins']['employee'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[admins][employee][]" value="update"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['employee']) && is_array($perm['admins']['employee']) && in_array('update', $perm['admins']['employee'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[admins][employee][]" value="delete"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['employee']) && is_array($perm['admins']['employee']) && in_array('delete', $perm['admins']['employee'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Admin <input type="hidden" name="usertype[admins][admin]" value="admin"></td>
                                                                <td><input type="checkbox" name="grants[admins][admin][]" value="create"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['admin']) && is_array($perm['admins']['admin']) && in_array('create', $perm['admins']['admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[admins][admin][]" value="read"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['admin']) && is_array($perm['admins']['admin']) && in_array('read', $perm['admins']['admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[admins][admin][]" value="update"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['admin']) && is_array($perm['admins']['admin']) && in_array('update', $perm['admins']['admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[admins][admin][]" value="delete"
                                                                    {{(isset($perm['admins']) && is_array($perm['admins']) && isset($perm['admins']['admin']) && is_array($perm['admins']['admin']) && in_array('delete', $perm['admins']['admin'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Permissions <input type="hidden" name="slug[permissions]" value="permissions"></th>
                                            <td colspan="6">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>User Types</th>
                                                                <th>Create</th>
                                                                <th>Read</th>
                                                                <th>Update</th>
                                                                <th>Delete</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Super Admin <input type="hidden" name="usertype[permissions][super-admin]" value="super-admin"></td>
                                                                <td><input type="checkbox" name="grants[permissions][super-admin][]" value="create"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['super-admin']) && is_array($perm['permissions']['super-admin']) && in_array('create', $perm['permissions']['super-admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[permissions][super-admin][]" value="read"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['super-admin']) && is_array($perm['permissions']['super-admin']) && in_array('read', $perm['permissions']['super-admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[permissions][super-admin][]" value="update"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['super-admin']) && is_array($perm['permissions']['super-admin']) && in_array('update', $perm['permissions']['super-admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[permissions][super-admin][]" value="delete"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['super-admin']) && is_array($perm['permissions']['super-admin']) && in_array('delete', $perm['permissions']['super-admin'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Company <input type="hidden" name="usertype[permissions][company]" value="company"></td>
                                                                <td><input type="checkbox" name="grants[permissions][company][]" value="create"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['company']) && is_array($perm['permissions']['company']) && in_array('create', $perm['permissions']['company'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[permissions][company][]" value="read"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['company']) && is_array($perm['permissions']['company']) && in_array('read', $perm['permissions']['company'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[permissions][company][]" value="update"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['company']) && is_array($perm['permissions']['company']) && in_array('update', $perm['permissions']['company'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[permissions][company][]" value="delete"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['company']) && is_array($perm['permissions']['company']) && in_array('delete', $perm['permissions']['company'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Employees <input type="hidden" name="usertype[permissions][employee]" value="employee"></td>
                                                                <td><input type="checkbox" name="grants[permissions][employee][]" value="create"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['employee']) && is_array($perm['permissions']['employee']) && in_array('create', $perm['permissions']['employee'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[permissions][employee][]" value="read"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['employee']) && is_array($perm['permissions']['employee']) && in_array('read', $perm['permissions']['employee'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[permissions][employee][]" value="update"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['employee']) && is_array($perm['permissions']['employee']) && in_array('update', $perm['permissions']['employee'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[permissions][employee][]" value="delete"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['employee']) && is_array($perm['permissions']['employee']) && in_array('delete', $perm['permissions']['employee'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Admin <input type="hidden" name="usertype[permissions][admin]" value="admin"></td>
                                                                <td><input type="checkbox" name="grants[permissions][admin][]" value="create"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['admin']) && is_array($perm['permissions']['admin']) && in_array('create', $perm['permissions']['admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[permissions][admin][]" value="read"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['admin']) && is_array($perm['permissions']['admin']) && in_array('read', $perm['permissions']['admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[permissions][admin][]" value="update"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['admin']) && is_array($perm['permissions']['admin']) && in_array('update', $perm['permissions']['admin'])) ? 'checked' : '' }}></td>
                                                                <td><input type="checkbox" name="grants[permissions][admin][]" value="delete"
                                                                    {{(isset($perm['permissions']) && is_array($perm['permissions']) && isset($perm['permissions']['admin']) && is_array($perm['permissions']['admin']) && in_array('delete', $perm['permissions']['admin'])) ? 'checked' : '' }}></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@section('extra-js')    
    <script type="text/javascript">
        $(document).ready(function(){
           
        });
    </script>
@endsection