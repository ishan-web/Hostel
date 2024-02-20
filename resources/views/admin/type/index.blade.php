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
          <h5 class="card-header">All Room Types</h5>        
            <div class="dropdown" style=" display: flex; justify-content: flex-end;">
            <a class="btn btn-primary" style="margin: 10px; color:white;" data-bs-toggle="modal" data-bs-target="#largeModal">Add Room Types</a>
            </div>
          <div class="table-responsive text-nowrap">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>S no.</th>
                  <th>Room Type</th>
                  <th>Capacity</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
              @foreach ($type as $key => $item)         
              <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{  ++ $key }}</strong></td>
                  <td>{{ $item->name }}</td>
                  <td>{{ $item->capacity }}</td>

                  <td>
                    
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('type.edit',$item->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>

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
                    <h5 class="modal-title" id="exampleModalLabel3">Add Room Type</h5>
                    <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    ></button>
                </div>
            <form method="post" action="{{route('type.store')}}" enctype="multipart/form-data">
                @csrf    
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailLarge" class="form-label">Room Type</label>
                            <input type="text" id="emailLarge" class="form-control" name="name" />
                        </div>
                        <div class="col mb-0">
                            <label class="form-label">Cost</label>
                            <input type="text"  class="form-control" name="cost" />
                        </div>
                        <div class="col mb-0">
                            <label for="dobLarge" class="form-label">Capacity</label>
                            <input type="number" max=4 min=1 id="dobLarge" class="form-control" name="capacity"  />
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
        var address='{{url('/type')}}'+'/'+id;
        form.prop('action',address)
    }
</script>

@endsection