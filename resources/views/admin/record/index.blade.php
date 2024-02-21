@extends('layouts.adminmaster')
@section('admincontent') 


<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Student /</span> Records</h4>
      
    

        <div class="card">
          <h5 class="card-header">Student Records Details</h5>       

            <div class="dropdown" style=" display: flex; justify-content: flex-end;">

        </div>
          <div class="table-responsive text-nowrap" style="overflow-x:auto; padding:10px;">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>S no.</th>
                  <th>Name</th>                  
                  <th>Phone</th>
                  <th>Status</th>
                  <th>Username</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
              @foreach ($std as $key => $item)         
              <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{  ++ $key }}</strong></td>
                    <td>{{$item->name}}</td>

                    <td>{{$item->phone}}</td>

                    @if($item->status == 0)
                      <td style="color:green">IN</td>
                      @else
                      <td style="color:red">OUT</td>
                    @endif

                  @foreach($users as $key => $t)
                    @if($t['id'] == $item->user_id)
                      <td>{{ $t->name }}</td>
                    @endif
                  @endforeach

                
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

   


@endsection

