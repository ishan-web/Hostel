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
          <h5 class="card-header">All Vehicle</h5>        
            <div class="dropdown" style=" display: flex; justify-content: flex-end;">

              <a class="btn btn-primary" style="margin: 10px; color:white;" data-bs-toggle="modal" data-bs-target="#largeModal">Add Roles</a>

            </div>
          <div class="table-responsive text-nowrap">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>S no.</th>
                  <th>Name</th>
                  <th>Number</th>
                  <th>Wheel</th>
                  <th>Category</th>
                  <th>Capacity</th>
                  <th>Driver</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
              @foreach ($vehicle as $item)         
              <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{  ++ $key }}</strong></td>
                  <td>{{ $role->name }}</td>
                  <td>{{ $role->number }}</td>
                  <td>{{ $role->wheel }}</td>
                  <td>{{ $role->category }}</td>
                  <td>{{ $role->capacity }}</td>
                  <td>{{ $role->driver }}</td>
                  <td>

                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-modal" onclick="edit('{{$per->id}}','{{$per->name}}')"><i class="bx bx-edit-alt me-1"></i> Edit</button>

                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal" onclick="destroy('{{$per->id}}')"><i class="bx bx-trash me-1"></i> Delete</button>
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
                    <h5 class="modal-title" id="exampleModalLabel3">Modal title</h5>
                    <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    ></button>
                </div>
            <form method="post" action="{{route('vehicles.store')}}" enctype="multipart/form-data">
                @csrf    
                <div class="modal-body">
                    <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailLarge" class="form-label">Vehicle Name</label>
                        <input type="text" id="emailLarge" class="form-control" name="name" placeholder="name...." />
                    </div>
                    <div class="col mb-0">
                        <label for="dobLarge" class="form-label">Number</label>
                        <input type="text" id="dobLarge" class="form-control" name="number" placeholder="vehicle number..." />
                    </div>
                    </div>
                    <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailLarge" class="form-label">Wheel</label>
                        <input type="text" id="emailLarge" class="form-control" name="wheel" placeholder="wheels...." />
                    </div>
                    <div class="col mb-0">
                        <label for="dobLarge" class="form-label">Category</label>
                        <input type="text" id="dobLarge" class="form-control" name="category" placeholder="Category....." />
                    </div>
                    </div>
                    <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailLarge" class="form-label">Capacity</label>
                        <input type="text" id="emailLarge" class="form-control" name="capacity" placeholder="capacity...." />
                    </div>
                    <div class="col mb-0">
                        <label for="dobLarge" class="form-label">Driver</label>
                        <input type="text" id="dobLarge" class="form-control" name="driver" placeholder="driver...." />
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
          <input type="hidden" name="id" id="id">
          <div class="modal-body">
            <div class="row gutters-15">
                <div class="form-group col-6">
                  <label for="defaultFormControlInput" class="form-label">Name <span style="color:red;">*</span></label>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id'=>'name')) !!}
                </div>
                <div  class="form-group col-6">
                  <label for="defaultFormControlInput" class="form-label">Select Category <span style="color:red;">*</span></label>
                    <select class="form-select" name="category" id="defaultSelect">
                      <option>Please Select Category</option>
                      @foreach($vehicle as $key=>$category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                    </select>
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


@endsection