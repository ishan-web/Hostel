@extends('layouts.adminmaster')

@section('admincontent')

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
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
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Room</h2>
        </div>
    </div>
</div>
<div class="card">

    <div class="col-md-12" style="padding: 30px;">
        <form method="POST" action="{{ route('type.update', $type->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">

                <div class="col-md-6 col-xl-6 mb-4">
                    <label for="emailLarge" class="form-label">Room Type</label>
                        <div class="col-md-8"> <!-- Changed col-md-6 to col-md-8 -->
                        <input type="text" id="emailLarge" value="{{$type->name}}" class="form-control" name="name" />
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-6 mb-4">
                    <label for="dobLarge" class="form-label">Capacity</label>
                        <div class="col-md-8"> <!-- Changed col-md-6 to col-md-8 -->
                        <input type="number" max=4 min=1 value="{{$type->capacity}}" class="form-control" name="capacity"  />

                    
                        </div>
                    </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <a class="btn btn-primary" style="margin:10px;" href="{{ route('type.index') }}"> Back</a>

                        <button type="submit" class="btn btn-success">Update</button>

                    </div>
                </div>
            </div>
        </form>
    </div>

</div>                    
</div>


@endsection