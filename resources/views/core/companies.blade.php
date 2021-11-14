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
        @if (Auth::check() && Auth::user()->hasPermission('companies', Auth::user()->usertype, 'create'))
          <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a class="btn btn-primary text-white btn-sm" data-toggle="modal" data-target="#add-companies"><i class="la la-plus-circle"></i> Add {{ucwords($title)}}</a></li>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Logo</th>
                                            <th>Website</th>
                                            @if (Auth::user()->usertype == 'super-admin')
                                            <th>Added By</th>
                                            @endif
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($companies as $key => $company)
                                            <tr>
                                                <td>{{$company->name}}</td>
                                                <td>{{$company->email}}</td>
                                                <td><img src="/storage/{{$company->logo}}" style="max-width: 37px;max-height: 37px;"></td>
                                                <td>
                                                    @if ($company->website)
                                                    <a href="{{$company->website}}">{{$company->website}}</a>
                                                    @endif  
                                                    
                                                </td>
                                                @if (Auth::user()->usertype == 'super-admin')
                                                <td>{{$company->createdByUser->name}}</td>
                                                @endif

                                                <td class="align-right">
                                                    @if (Auth::check() && Auth::user()->hasPermission('companies', Auth::user()->usertype, 'update'))
                                                    <a class="edit-company badge badge-primary text-white" 
                                                        data-eid="{{$company->id}}"
                                                        data-ename="{{$company->name}}"
                                                        data-eemail="{{$company->email}}"
                                                        data-eclogo="/storage/{{$company->logo}}"
                                                        data-ewebsite="{{$company->website}}" 
                                                        data-toggle="modal" 
                                                        data-target="#edit-companies"><i class="la la-pencil-square-o"></i>
                                                    </a>
                                                    @endif
                                                    @if (Auth::check() && Auth::user()->hasPermission('companies', Auth::user()->usertype, 'delete'))
                                                    <a class="delete-company badge badge-primary text-white" 
                                                        data-did="{{$company->id}}"
                                                        data-dname="{{$company->name}}"><i class="la la-trash"></i>
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6">No companies record at the moment.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{ $companies->links() }}
            </div>
        </div>
    </div>
</div>

@if (Auth::check() && Auth::user()->hasPermission('companies', Auth::user()->usertype, 'create'))
<div class="modal fade" id="add-companies" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Company Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="la la-close"></i></button>
            </div>
            <form action="{{url('add-companies')}}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <label>Name: </label>
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Company name" class="form-control" value="{{old('name')}}">
                    </div>
                    @csrf
                    <label>Email: </label>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Company email" class="form-control" value="{{old('email')}}">
                    </div>

                    <label>Logo: </label>
                    <div class="form-group">
                        <input type="file" name="clogo" placeholder="Choose an Image" class="form-control" accept="image/*">
                    </div>

                    <label>Website: </label>
                    <div class="form-group">
                        <input type="text" name="website" placeholder="Company website" class="form-control" value="{{old('website')}}">
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

@if (Auth::check() && Auth::user()->hasPermission('companies', Auth::user()->usertype, 'update'))
<div class="modal fade" id="edit-companies" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Company Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="la la-close"></i></button>
            </div>
            <form action="{{url('edit-companies')}}" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="eid">
                <div class="modal-body">
                    <label>Name: </label>
                    <div class="form-group">
                        <input type="text" name="ename" placeholder="Company name" class="form-control" value="{{old('ename')}}">
                    </div>
                    @csrf
                    <label>Email: </label>
                    <div class="form-group">
                        <input type="email" name="eemail" placeholder="Company email" class="form-control" value="{{old('eemail')}}">
                    </div>

                    <label>Logo: </label>
                    <div class="form-group">
                        <input type="file" name="eclogo" placeholder="Choose an Image" class="form-control" accept="image/*">
                        <img src="" style="max-width: 80px;max-height: 80px;">
                    </div>

                    <label>Website: </label>
                    <div class="form-group">
                        <input type="text" name="ewebsite" placeholder="Company website" class="form-control" value="{{old('ewebsite')}}">
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
            $('.edit-company').on('click', function(){
                let self = $(this);
                $('input[name="eid"]').val(self.data('eid'));
                $('input[name="ename"]').val(self.data('ename'));
                $('input[name="eemail"]').val(self.data('eemail'));
                $('input[name="eclogo"]').next('img').attr('src',self.data('eclogo'));
                $('input[name="ewebsite"]').val(self.data('ewebsite'));
            });

            $('.delete-company').on('click', function(){
                let self = $(this);
                if(confirm('Are you sure you want to delete ['+ self.data('dname') +'] company?'))
                    window.location.href = "{{url('delete-company')}}/"+ self.data('did');
                return ;
            });
        });
    </script>
@endsection