@extends('layouts.studentmaster')
@section('usercontent') 


<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Feedback /</span> All Posts</h4>
     
      
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
          <h5 class="card-header">All Feedbacks</h5>        
            <div class="dropdown" style=" display: flex; justify-content: flex-end;">
            <a class="btn btn-primary" style="margin: 10px; color:white;" data-bs-toggle="modal" data-bs-target="#largeModal">Add Post</a>
            </div>
            <hr>
            <div class="row">
            @foreach($feed as $key => $item)
            <div class="bs-toast toast fade show border border-primary bg-white col-md-12" style="margin: 20px;" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header text-white">
                    <div class="me-auto fw-bold text-success">{{ $item->name }}</div>
                    <small class="text-success">{{ $item->created_at->diffForHumans() }}</small>
                </div>
                <div class="toast-body">
                    - {{ $item->post }}
                </div>
            </div>


            <hr>
            @endforeach
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
                    <h5 class="modal-title" id="exampleModalLabel3">Add Post</h5>
                    <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    ></button>
                </div>
            <form method="post" action="{{route('feed.store')}}" enctype="multipart/form-data">
                @csrf    
                <div class="modal-body">
                    <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailLarge" class="form-label">Post</label>
                        <textarea id="emailLarge" class="form-control" name="post"></textarea>
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

    
@endsection

