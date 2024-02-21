@extends('layouts.adminmaster')
@section('admincontent') 


<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Studnet /</span> Attendance</h4>
      
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
        
        @elseif($message = Session::get('failure'))
        <div class="alert alert-danger alert-dismissible" role="alert">
          {{ $message}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card">
          <h5 class="card-header">All Attendance</h5>        
            <div class="dropdown" style=" display: flex; justify-content: flex-end;">
            @can('edit-attendance')

            <a class="btn btn-primary" style="margin: 10px; color:white;" data-bs-toggle="modal" data-bs-target="#largeModal">Add Attendance</a>
            @endcan

          </div>
          <div class="table-responsive text-nowrap">
            <table class="table table-striped" id="myTable">
              <thead>
                <tr>
                  <th>S.N.</th>
                  <th>Student Name</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
              @foreach ($att as $key => $item)         
              <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{  ++ $key }}</strong></td>
                  
                  @foreach($students as $key => $t)
                    @if($t['id'] == $item['student_id'])
                      <td>{{ $t->name }}</td>
                    @endif
                  @endforeach   

                  @if($item['status'] == 0)
                  <td>
                    Present
                  </td>
                  @else
                  <td>
                    Absent                  
                  </td>
                  @endif

                  <td>{{ $item->date }}</td>
                  <td> 
                  @can('edit-attendance')
                   
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('attendance.edit',$item->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>

                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal" onclick="destroy('{{$item->id}}')"><i class="bx bx-trash me-1"></i> Delete</button>
                      </div>
                    </div>    
                    @endcan
                  
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
                    <h5 class="modal-title" id="exampleModalLabel3">Date: {{ now()->toDateString() }} </h5>
                    <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    ></button>
                </div>
                  <form method="POST" action="{{ route('attendance.store') }}">
                      @csrf
                      <input type="hidden" name="date" value="{{ now()->toDateString() }}">
                      <div class="table-responsive">
                          <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th>Name</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($students as $student)
                                  <tr>
                                      <td>{{ $student->name }}</td>
                                      <td>
                                          <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                              <label class="form-check-label mb-0 me-3" for="status_absent_{{ $student->id }}">Present</label>
                                              <input class="form-check-input" type="checkbox" id="status_absent_{{ $student->id }}" name="status[{{ $student->id }}]" value="0">
                                              <label class="form-check-label mb-0 me-3" for="status_present_{{ $student->id }}">Absent</label>
                                              <input class="form-check-input" type="checkbox" id="status_present_{{ $student->id }}" name="status[{{ $student->id }}]" value="1">
                                          </div>
                                      </td>
                                  </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                      <button type="submit" class="btn btn-primary float-end" style="margin:10px;">Save Attendance</button>
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
        var address='{{url('/attendance')}}'+'/'+id;
        form.prop('action',address)
    }
</script>

@endsection