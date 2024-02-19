@extends('layouts.adminmaster')
@section('admincontent') 


<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>
      
      @if ($errors = Session::get('errors'))
          <div class="alert alert-danger alert-dismissible" role="alert">
              @foreach ($errors as $error)
                  {{ $error }}<br>
              @endforeach
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

      @if ($message = Session::get('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
              {{ $message }}          
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

      @if ($message = Session::get('failure'))
          <div class="alert alert-danger alert-dismissible" role="alert">
              {{ $message}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif


        <div class="card">
          <h5 class="card-header">Student Details</h5>       

            <div class="dropdown" style=" display: flex; justify-content: flex-end;">
            <a class="btn btn-primary" style="margin: 10px; color:white;" data-bs-toggle="modal" data-bs-target="#largeModal">Add Student</a>
            </div>
          <div class="table-responsive text-nowrap" style="overflow-x:auto">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>S no.</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Image</th>
                  <th>Phone</th>
                  <th>Gender</th>
                  <th>Date of Birth</th>
                  <th>Status</th>
                  <th>Username</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
              @foreach ($std as $key => $item)         
              <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{  ++ $key }}</strong></td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->address}}</td>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('images/' . $item->image) }}" alt="Student Image" style="max-width: 100px;">
                            @else
                            No Image
                        @endif
                    </td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->gender}}</td>
                    <td>{{$item->dob}}</td>

                    @if($item->status == 0)
                      <td>Shown</td>
                      @else
                      <td>False</td>
                    @endif

                  @foreach($users as $key => $t)
                    @if($t['id'] == $item->user_id)
                      <td>{{ $t->name }}</td>
                    @endif
                  @endforeach

                  <td>                    
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('student.edit',$item->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>

                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal" onclick="destroy('{{$item->id}}')"><i class="bx bx-trash me-1"></i> Delete</button>
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
<!--/ Striped Rows -->

        <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Add Room</h5>
                    <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    ></button>
                </div>
            <form method="post" action="{{route('student.store')}}" enctype="multipart/form-data">
                @csrf    
                <div class="modal-body">
                    <div class="row">
                        <div class="row g-2">
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" required/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Date Of Birth</label>
                                <input type="date" class="form-control" name="dob" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="users" class="form-label">Users</label>
                                <select class="form-select" name="user_id">
                                    @foreach($users as $key => $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" name="gender">                            
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status">                            
                                    <option value="0">Show</option>
                                    <option value="1">Hide</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" />
                            </div>
                        </div>                    
                    </div>                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>                
            </form>
                </div>
            </div>
        </div>


  <!-- Modal -->
    <div class="modal fade" id="delete-modal" data-bs-backdrop="static" tabindex="-1">
      <div class="modal-dialog">
        <form class="modal-content" id="delete_form" method="post" action="">
          <div class="modal-header">
            <h5 class="modal-title" id="backDropModalTitle">Delete Student Details?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>           
          </div>
            <p  style="margin-left: 20px; margin-top: 20px;">Are You sure You want to delete this student's details ?</p>
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
          var address='{{url('/student')}}'+'/'+id;
          form.prop('action',address)
      }
  </script>

@endsection