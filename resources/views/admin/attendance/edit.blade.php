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
            <h2>Edit Attendance</h2>
        </div>
    </div>
</div>
<div class="card">

    <div class="col-md-12" style="padding: 30px;">
        <form method="POST" action="{{ route('attendance.update', $att->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="date" class="form-control float-end" name="date" value="{{ $att->date}}">
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
                            @if($student['id'] == $att['student_id'])
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>
                                <div class="form-check form-switch d-flex justify-content-between align-items-center">
                                    <label class="form-check-label mb-0 me-3" for="status_absent_{{ $student->id }}">Present</label>
                                    <input class="form-check-input" type="checkbox" id="status_absent_{{ $student->id }}" name="status[{{ $student->id }}]" value="0" {{ $att[$student->id] == 1 ? 'checked' : '' }} onclick="toggleCheckbox(this)">
                                    <label class="form-check-label mb-0 me-3" for="status_present_{{ $student->id }}">Absent</label>
                                    <input class="form-check-input" type="checkbox" id="status_present_{{ $student->id }}" name="status[{{ $student->id }}]" value="1" {{ $att[$student->id] == 0 ? 'checked' : '' }} onclick="toggleCheckbox(this)">
                                </div>

                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

            <button type="submit" class="btn btn-primary float-end" style="margin:10px;">Save Attendance</button>
        </form>
    </div>

</div>                    
</div>

<script>
    function toggleCheckbox(checkbox) {
        const checkboxes = document.querySelectorAll(`input[name="${checkbox.name}"]`);
        checkboxes.forEach((cb) => {
            if (cb !== checkbox) {
                cb.checked = false;
            }
        });
    }
</script>
@endsection