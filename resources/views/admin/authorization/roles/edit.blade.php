@extends('layouts.adminmaster')


@section('admincontent')

<!-- Breadcubs Area Start Here -->

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
    <!-- Breadcubs Area End Here -->
    <!-- Student Table Area Start Here -->
    <div class="card height-auto">
      <div class="card-body">
        <div class="heading-layout1">
          <div class="item-title">
            <h3>Edit Role</h3>
          </div>
        </div>
        <form method="POST" action="{{url('roles/'.$role->id)}}" class="new-added-form">
            @csrf
            {{method_field('PATCH')}}
                <div class="row gutters-20">
                  <div class="col-xl-12 col-lg-6 col-12 form-group mb-2">
                      <label for="defaultFormControlInput" class="form-label">Name *</label>
                      {!! Form::text('name', $role->name, array('placeholder' => 'Name','class' => 'form-control')) !!}
                  </div>
            
                    <div class="col-xl-12">
                        <label for="defaultFormControlInput" class="form-label">Permission *</label><br>
                    </div>
                    @foreach($permissioncategory as $value)
                    <div class="table-responsive">
                      <table class="table table-striped table-borderless border-bottom">
                        <thead>
                          <tr>
                            <th>
                              <div class="d-flex ">
                                <label class="badge bg-label-info me-1 ">{{$value->name}}<label>
                              </div>
                            </th>
                          </tr>
                        </thead>
                        <tbody >
                          <tr>
                        @foreach($value->permission as $data)
                            <td>
                              <div class="form-check d-flex ">                                

                                <label>{{ Form::checkbox('permission[]', $data->id, in_array($data->id, $rolePermissions) ? true : false, array('class' => 'name')) }}  {{ $data->name }}</label>

                              </div>
                            </td>    
                        @endforeach                        
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    @endforeach
                </div>
            
              <div class="row mt-3">
                  <div class="col-12 form-group mg-t-8">
                  <a type="button" class="btn btn-outline-secondary" href="{{url('roles')}}"> Back </a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
              </div>
        </form>
      </div>
    </div>
  </div>
 </div>




@endsection