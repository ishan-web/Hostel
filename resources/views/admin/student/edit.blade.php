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

<div class="row">
    <div class="col-md-6">
        <form method="POST" action="{{ route('student.update', $student->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                <div class="col-md-8">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $student->name }}" required autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                <div class="col-md-8">
                    <input id="address" type="text" class="form-control" name="address" value="{{ $student->address }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                <div class="col-md-8">
                    <input id="phone" type="text" class="form-control" name="phone" value="{{ $student->phone }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="dob" class="col-md-4 col-form-label text-md-right">Date of Birth</label>
                <div class="col-md-8">
                    <input id="dob" type="date" class="form-control" name="dob" value="{{ $student->dob }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                <div class="col-md-8">
                    <select id="gender" class="form-select" name="gender">
                        <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
                <div class="col-md-8">
                    <select id="status" class="form-select" name="status">
                        <option value="0" {{ $student->status == 0 ? 'selected' : '' }}>Show</option>
                        <option value="1" {{ $student->status == 1 ? 'selected' : '' }}>Hide</option>
                    </select>
                </div>
            </div>
            <div class="col mb-0">
                <label for="room_id" class="form-label">Username</label>
                <select class="form-select" name="user_id">
                    @foreach($users as $key => $item)
                        <option value="{{ $item->id }}" {{ $student->user_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group row">
                <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                <div class="col-md-8">
                    <input id="image" type="file" class="form-control" name="image">
                    @if ($student->image)
                    <img src="{{ asset('images/'.$student->image) }}" alt="Student Image" class="mt-2" style="max-width: 200px;">
                    @endif
                </div>
            </div>


            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>




</div>                    
</div>


@endsection