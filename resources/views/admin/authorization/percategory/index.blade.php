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
          <h5 class="card-header">All Permission</h5>        
            <div class="dropdown" style=" display: flex; justify-content: flex-end;">
              <a class="btn btn-primary" style="margin: 10px; color:white;" data-bs-toggle="modal" data-bs-target="#large-modal">Add Permission Category</a>
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
              @foreach ($list as $key => $per)              
              <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{  ++ $key }}</strong></td>
                  <td>{{ $per->name }}</td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        @can('percategory-edit')
                          <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-modal" onclick="edit('{{$per->id}}','{{$per->name}}')"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                          @endcan
                          @can('percategory-delete')
                          <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal" onclick="destroy('{{$per->id}}')"><i class="bx bx-trash me-1"></i> Delete</button>
                        @endcan
                      </div>
                    </div>
                  </td>
                </tr>              
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


    <div class="modal fade" id="large-modal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel3">Add Permission Group</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          {!! Form::open(array('route' => 'percategory.store','method'=>'POST','class'=>'new-added-form')) !!}
            <div class="modal-body">
                <div class="row gutters-15">
                      <div class="form-group col-6">
                        <label for="defaultFormControlInput" class="form-label">Name <span class="text-red">*</span></label>
                          {!! Form::text('name', null, array('placeholder' => 'Permission Group Name','class' => 'form-control')) !!}
                      </div>
                  </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>


    <div class="modal fade" id="edit-modal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel3">Edit Permission Group</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          {!! Form::open(array('class'=>'new-added-form','id'=>'edit-form')) !!}
          @csrf
            <div class="modal-body">
                <div class="row gutters-15">
                      <div class="form-group col-6">
                        <label for="defaultFormControlInput" class="form-label">Name <span class="text-red">*</span></label>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id'=>'name')) !!}
                      </div>
                  </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>



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
  function edit(id,name){
  	$('#id').val(id);
    $('#name').val(name);
    var form=$('#edit-form');
        var address='{{url('/percategory')}}'; 
        form.prop('action',address)
  }

  function destroy(id){
        var form=$('#delete_form');
        var address='{{url('/percategory')}}'+'/'+id;
        form.prop('action',address)
    }
</script>
@endsection