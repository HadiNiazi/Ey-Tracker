@extends('layouts.admin')

@section('title', 'New Admission | Admin Dashboard')

@section('styles')
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admissions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">New Admission</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Edit Class</h3>
                  </div>
                  <!-- /.card-header -->

                   @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                  <!-- form start -->
                  <form method="post" action="{{ route('admin.classes.update', $class->id) }}" id="quickForm" novalidate="novalidate">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label class="col-form-label">Name <span style="color:red;"> *</span> </label>
                                  <input autocomplete="no" class="form-control m-input col-md-12" name="name" value="{{ old('name', $class->name) }}" type="text" placeholder="Name" required="">
                              </div>
                          </div>
                      </div>

                    <div class="container-fluid">
                      <div class="row">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>

                    </div>
                    <!-- /.card-body -->
                  </form>
                </div>
                <!-- /.card -->
                </div>
              <!--/.col (left) -->
              <!-- right column -->
              <div class="col-md-6">

              </div>
              <!--/.col (right) -->
            </div>
            <!-- /.row -->
          </div>

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')
@endsection
