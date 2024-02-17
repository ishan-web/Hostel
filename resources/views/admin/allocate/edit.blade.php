@extends('layouts.adminmaster')

@section('admincontent')

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
      
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Room</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" style="margin:10px;" href="{{ route('allocate.index') }}"> Back</a>
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
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-success" data-bs-dismiss="modal">Submit</button>
    </div>
</form>


</div>                    
</div>


@endsection