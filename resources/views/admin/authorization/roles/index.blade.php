@extends('layouts.adminmaster')
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
          <h5 class="card-header">All Roles</h5>        
            <div class="dropdown" style=" display: flex; justify-content: flex-end;">
            @if(Auth::user()->user_type == 'admin')

              <a class="btn btn-primary" style="margin: 10px; color:white;" href="{{url('roles/create')}}">Add Roles</a>
            @endif
            </div>
          <div class="table-responsive text-nowrap">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>S no.</th>
                  <th>Name</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
              @foreach ($roles as $key => $role)         
              <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{  ++ $key }}</strong></td>
                  <td>{{ $role->name }}</td>
                  <td>
                  @if(Auth::user()->user_type == 'admin')

                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('roles.edit',$role->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>

                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal" onclick="destroy('{{$role->id}}')"><i class="bx bx-trash me-1"></i> Delete</button>
                      </div>
                    </div> 
                    @endif                     
                  </td>
                </tr>              
              @endforeach
              </tbody>
            </table>
            {!! $roles->render() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Striped Rows -->


  <!-- Modal -->
    <div class="modal fade" id="delete-modal" data-bs-backdrop="static" tabindex="-1">
      <div class="modal-dialog">
        <form class="modal-content" id="delete_form" method="post" action="">
          <div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle">Delete Permission Group?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>           
          </div>
            <p  style="margin-left: 20px; margin-top: 20px;">Are You sure You want to delete this Permission Group?</p>
            <div class="modal-footer">
                  {{csrf_field()}}
                  {{method_field('DELETE')}}
            </div> 
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>

@endsection


@section('scripts')

<script type="text/javascript">
  function destroy(id){
        var form=$('#delete_form');
        var address='{{url('/roles')}}'+'/'+id;
        form.prop('action',address)
    }
</script>

@endsection