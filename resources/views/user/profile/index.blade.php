@extends('layouts.studentmaster')

@section('usercontent')

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
  
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Student Profile</h2>
        </div>
    </div>
</div>
<div class="card">

    <div class="col-md-12" style="padding: 30px;">
            <div class="row">
                <div class="col-md-6 col-xl-6 mb-4">
                    <label for="name" class="col-md-4 col-form-label">Name</label>
                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control" value="{{ isset($student['name']) ? $student['name'] : '' }}" autofocus>
                    </div>

                </div>


                <div class="col-md-6 col-xl-6 mb-4">
                    <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                    <div class="col-md-8">
                        <input id="address" type="text" class="form-control" name="address" value="{{ $student ? $student->address : '' }}">
                    </div>

                </div>

                <div class="col-md-6 col-xl-6 mb-4">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                    <div class="col-md-8">
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ $student ? $student->phone : '' }}">
                    </div>

                </div>

                <div class="col-md-6 col-xl-6 mb-4">
                    <label for="dob" class="col-md-4 col-form-label text-md-right">Date of Birth</label>
                    <div class="col-md-8">
                        <input id="dob" type="date" class="form-control" name="dob" value="{{ $student ? $student->dob : '' }}">
                    </div>

                </div>

                <div class="col-md-6 col-xl-6 mb-4">
                    <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                    <div class="col-md-8">
                        <select id="gender" class="form-select" name="gender">
                            <option value="male" {{ isset($student) && $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ isset($student) && $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                </div>               

                <div class="col-md-6 col-xl-6 mb-4">
                    <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                    <div class="col-md-8">
                        <input id="image" type="file" class="form-control" name="image">
                        @if ($student->image)
                            <div class="mt-2">
                                <img src="{{ asset('images/'.$student->image) }}" alt="Student Image" style="max-width: 100px;">
                            </div>
                        @endif
                    </div>


                </div>
               
            </div>
    </div>





</div>                    
</div>


@endsection