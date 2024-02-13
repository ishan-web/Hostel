@extends('layouts.adminmaster')
@section('styles')
<link rel="stylesheet" href="{{asset('css/admincss/select2.min.css')}}">
@endsection
@section('admincontent')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>
        
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
          {{ $message }}          
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
        @elseif($message = Session::get('failure'))
        <div class="alert alert-danger alert-dismissible" role="alert">
          {{ $message}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
      <div class="card">
          <h5 class="card-header">All Students</h5>        
            <div class="dropdown" style=" display: flex; justify-content: flex-end;">
                <a class="btn btn-primary" style="margin: 10px; color:white;" data-bs-toggle="modal" data-bs-target="#large-modal">Add User</a>

            </div>
            <div class="table-responsive">
              <table class="table display data-table text-nowrap">
                <thead>
                  <tr>
                    <th>S no.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Room No.</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $key => $user)
                  @if($user->roles->pluck(['name'])->implode(',')!=="superadmin")
                  <tr>

                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    @foreach($rooms as $key=> $room)
                      @if($room['id'] = $user->room_id)
                        <td>{{$room['name']}}</td>
                        @else
                        <td>Empty</td>
                      @endif
                    @endforeach
                    
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-modal" onclick="edit('{{$user->id}}','{{$user->name}}','{{$user->email}}','{{$user->roles->pluck(['name'])->implode(',')}}','{{$user->room_id}}')">Edit</a>

                          <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal" onclick="destroy('{{$user->id}}')">Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @else
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>  
                    
                    @foreach($rooms as $key=> $room)
                      @if($room['id'] = $user->room_id)
                        <td>{{$room['name']}}</td>
                      @endif
                    @endforeach
                    @if($user->id==Auth::user()->id)
                    <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" data-toggle="modal" data-target="#edit-modal" onclick="edit('{{$user->id}}','{{$user->name}}','{{$user->email}}','{{$user->roles->pluck('name')->implode(',')}}','{{$user->room_id}}')">Edit</a>              
                      </div>
                      </div>
                    </td>
                    @endif
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
              {!! $data->render() !!}
            </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="large-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add User</h5>
        <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(array('route' => 'users.store','method'=>'POST','class'=>'new-added-form')) !!}
      <div class="modal-body">
        <div class="row gutters-15">
          <div class="form-group col-6">
            <label>Name <span class="text-red">*</span></label>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
          </div>
          <div class="form-group col-6">
            <label>Email <span class="text-red">*</span></label>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
          </div>
          <div class="form-group col-sm-6">
            <label>Password <span class="text-red">*</span></label>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
          </div>
          <div class="form-group col-sm-6">
            <label>Confirm Password <span class="text-red">*</span></label>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
          </div>
          <div class="form-group col-6">
            <label for="defaultFormControlInput" class="form-label">Assign Room <span class="text-red">*</span></label>
              <select class="form-select" name="room_id" id="defaultSelect">
                <option>Assign Room.....</option>
                @foreach($rooms as $key=>$room)
                  <option value="{{$room->id}}">{{$room->name}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group col-6" hidden>
            <label>Select Role <span class="text-red">*</span></label>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control')) !!}
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Create User</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>


<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(array('class'=>'new-added-form','id'=>'edit-form')) !!}
      @csrf
      @method('patch')
      <div class="modal-body">
        <div class="row gutters-15">
          <div class="form-group col-6">
            <label>Name <span class="text-red">*</span></label>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id'=>'name')) !!}
          </div>
          <div class="form-group col-6">
            <label>Email <span class="text-red">*</span></label>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','id'=>'email')) !!}
          </div>
          <div class="form-group col-6">
            <label for="defaultFormControlInput" class="form-label">Assign Room <span class="text-red">*</span></label>
              <select class="form-select" name="room_id" id="room_id">
                <option>Assign Room.....</option>
                @foreach($rooms as $key=>$room)
                  <option value="{{$room->id}}">{{$room->name}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group col-6" hidden>
            <label>Select Role <span class="text-red">*</span></label>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','id'=>'roles')) !!}
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Edit User</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete User</h5>
        <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row gutters-15">
          <p>Are You sure You want to delete this user?</p>
        </div>
      </div>
      <div class="modal-footer">
        <form method="post" action="" id="delete_form">
          {{csrf_field()}}
          {{method_field('DELETE')}}
          <button type="submit" class="btn btn-danger">Delete</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
        </form>
      </div>

    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{asset('js/adminjs/select2.min.js')}}"></script>

<script type="text/javascript">
  function edit(id,name,email,roles,room_id)){
    $('#name').val(name);
    $('#email').val(email);
    $('#roles').val(roles).change();
    $('#room_id').val(room_id).change();
    var form=$('#edit-form');
        var address='{{url('users')}}'+'/'+id; 
        form.prop('action',address)
  }

  function destroy(id){
        var form=$('#delete_form');
        var address='{{url('/users')}}'+'/'+id;
        form.prop('action',address)
    }
</script>
@endsection