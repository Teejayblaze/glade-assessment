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
        @if (Auth::check() && Auth::user()->hasPermission('admins', Auth::user()->usertype, 'create'))
          <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a class="btn btn-primary text-white btn-sm" data-toggle="modal" data-target="#add-admin"><i class="la la-user-plus"></i> Add {{ucwords($title)}}</a></li>
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
                                            <th>Admin Type</th>
                                            <th>Email</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($admins as $key => $admin)
                                            <tr>
                                                <td>{{$admin->name}}</td>
                                                <td>{{ucfirst($admin->usertype)}}</td>
                                                <td>{{$admin->email}}</td>
                                                <td class="align-right">
                                                    @if (Auth::check() && Auth::user()->hasPermission('admins', Auth::user()->usertype, 'delete'))
                                                    <a class="delete-admin badge badge-primary text-white" 
                                                        data-did="{{$admin->id}}"
                                                        data-dname="{{$admin->name}}"><i class="la la-trash"></i>
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6">No admin record at the moment.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{ $admins->links() }}
            </div>
        </div>
    </div>
</div>


@if (Auth::check() && Auth::user()->hasPermission('admins', Auth::user()->usertype, 'create'))
<div class="modal fade" id="add-admin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Admin Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="la la-close"></i></button>
            </div>
            <form action="{{url('add-admin')}}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <label>Name: </label>
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Name" class="form-control" value="{{old('name')}}">
                    </div>
                    @csrf
                    <label>Email: </label>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" class="form-control" value="{{old('email')}}">
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

@section('extra-js')    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.delete-admin').on('click', function(){
                let self = $(this);
                if(confirm('Are you sure you want to delete ['+ self.data('dname') +'] as an admin?'))
                    window.location.href = "{{url('delete-admin')}}/"+ self.data('did');
                return ;
            });
        });
    </script>
@endsection