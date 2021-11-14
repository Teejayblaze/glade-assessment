<style type="text/css">
    .list-none {
        list-style-type: none;
    }
</style>
<div class="content-header row">
    <div class="content-header-left col-md-4 col-12 mb-2">
      <h3 class="content-header-title">{{ucwords($title)}}</h3>
    </div>
    <div class="content-header-right col-md-8 col-12">
      <div class="breadcrumbs-top float-md-right">
        <div class="breadcrumb-wrapper mr-1">
        @if (Auth::check() && Auth::user()->hasPermission('employees', Auth::user()->usertype, 'create'))
          <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a class="btn btn-primary text-white btn-sm" data-toggle="modal" data-target="#add-employee"><i class="la la-plus-circle"></i> Add {{ucwords($title)}}</a></li>
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
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>First name</th>
                                            <th>Last name</th>
                                            <th>Company</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            @if (Auth::user()->usertype == 'super-admin')
                                            <th>Added By</th>
                                            @endif
                                            <th width="12%">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($employees as $key => $employee)
                                            <tr>
                                                <td>{{$employee->firstname}}</td>
                                                <td>{{$employee->lastname}}</td>
                                                <td>{{$employee->companyRelated->name}}</td>
                                                <td>{{$employee->email}}</td>
                                                <td>{{$employee->phone}}</td>
                                                @if (Auth::user()->usertype == 'super-admin')
                                                <td>{{$employee->createdByUser->name}}</td>
                                                @endif
                                                <td class="align-right">
                                                    @if (Auth::check() && Auth::user()->hasPermission('employees', Auth::user()->usertype, 'update'))
                                                    <a class="edit-employee badge badge-primary text-white" 
                                                        data-eid="{{$employee->id}}"
                                                        data-efirstname="{{$employee->firstname}}"
                                                        data-elastname="{{$employee->lastname}}"
                                                        data-ecompany="{{$employee->company}}"
                                                        data-eemail="{{$employee->email}}"
                                                        data-ephone="{{$employee->phone}}"
                                                        data-toggle="modal" 
                                                        data-target="#edit-employee"><i class="la la-pencil-square-o"></i>
                                                    </a>
                                                    @endif
                                                    @if (Auth::check() && Auth::user()->hasPermission('employees', Auth::user()->usertype, 'delete'))
                                                    <a class="delete-employee badge badge-primary text-white" 
                                                        data-did="{{$employee->id}}"
                                                        data-dname="{{$employee->firstname .' '. $employee->lastname}}"><i class="la la-trash"></i>
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6">No employees record at the moment.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{ $employees->links() }}
            </div>
        </div>
    </div>
</div>

@if (Auth::check() && Auth::user()->hasPermission('employees', Auth::user()->usertype, 'create'))
<div class="modal fade" id="add-employee" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Employee Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="la la-close"></i></button>
            </div>
            <form action="{{url('add-employee')}}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <label>First name: </label>
                    <div class="form-group">
                        <input type="text" name="firstname" placeholder="First name" class="form-control" value="{{old('firstname')}}">
                    </div>
                    @csrf
                    <label>Last name: </label>
                    <div class="form-group">
                        <input type="text" name="lastname" placeholder="Last name" class="form-control" value="{{old('lastname')}}">
                    </div>

                    <label>Company: </label>
                    <div class="form-group">
                        <select name="company" id="company" class="form-control">
                            <option value="">- Select Company -</option>
                            @foreach ($companies as $company)
                            <option value="{{$company->id}}" {{$company->id == old('company') ? 'selected' : ''}} >{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label>Email: </label>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" class="form-control" value="{{old('email')}}">
                    </div>

                    <label>Phone: </label>
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Phone number" class="form-control" value="{{old('phone')}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="reset" class="btn btn-secondary" data-dismiss="modal" value="Close">
                    <input type="submit" class="btn btn-primary" value="Create Account">
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (Auth::check() && Auth::user()->hasPermission('employees', Auth::user()->usertype, 'update'))
<div class="modal fade" id="edit-employee" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Employee Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="la la-close"></i></button>
            </div>
            <form action="{{url('edit-employee')}}" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="eid">
                <div class="modal-body">
                    <label>First name: </label>
                    <div class="form-group">
                        <input type="text" name="efirstname" placeholder="First name" class="form-control" value="{{old('efirstname')}}">
                    </div>
                    @csrf
                    <label>Last name: </label>
                    <div class="form-group">
                        <input type="text" name="elastname" placeholder="Last name" class="form-control" value="{{old('elastname')}}">
                    </div>

                    <label>Company: </label>
                    <div class="form-group">
                        <select name="ecompany" id="company" class="form-control">
                            <option value="">- Select Company -</option>
                            @foreach ($companies as $company)
                            <option value="{{$company->id}}" {{$company->id == old('ecompany') ? 'selected' : ''}} >{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label>Email: </label>
                    <div class="form-group">
                        <input type="email" name="eemail" placeholder="Email" class="form-control" value="{{old('eemail')}}">
                    </div>

                    <label>Phone: </label>
                    <div class="form-group">
                        <input type="text" name="ephone" placeholder="Phone number" class="form-control" value="{{old('ephone')}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="reset" class="btn btn-secondary" data-dismiss="modal" value="Close">
                    <input type="submit" class="btn btn-primary" value="Modify Account">
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@section('extra-js')    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.edit-employee').on('click', function(){
                let self = $(this);
                $('input[name="eid"]').val(self.data('eid'));
                $('input[name="efirstname"]').val(self.data('efirstname'));
                $('input[name="elastname"]').val(self.data('elastname'));
                $('select[name="ecompany"]').val(self.data('ecompany'));
                $('input[name="eemail"]').val(self.data('eemail'));
                $('input[name="ephone"]').val(self.data('ephone'));
            });

            $('.delete-employee').on('click', function(){
                let self = $(this);
                if(confirm('Are you sure you want to delete ['+ self.data('dname') +'] as an employee?'))
                    window.location.href = "{{url('delete-employee')}}/"+ self.data('did');
                return ;
            });
        });
    </script>
@endsection