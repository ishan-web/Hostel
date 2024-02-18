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

<form method="post" action="{{ route('allocate.update', $allocate->id) }}">
    @csrf    
    @method('PATCH')

    <div class="modal-body">
        <div class="row g-2">
            <div class="col mb-0">
                <label for="room_id" class="form-label">Rooms</label>
                <select class="form-select" name="room_id">
                    @foreach($room as $key => $item)
                        <option value="{{ $item->id }}" {{ $allocate->room_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col mb-0">
                <label for="student_id" class="form-label">Students</label>
                <select class="form-select" name="student_id">
                    @foreach($students as $key => $item)
                        <option value="{{ $item->id }}" {{ $allocate->student_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>                    
    </div>
    <div class="modal-footer">
        <a class="btn btn-primary" style="margin:10px;" href="{{ route('allocate.index') }}"> Back</a>
        <button type="submit" class="btn btn-outline-success" data-bs-dismiss="modal">Submit</button>
    </div>
</form>


</div>                    
</div>


@endsection