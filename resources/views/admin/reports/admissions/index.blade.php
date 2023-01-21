@extends('layouts.admin')

@section('title', 'New Attendance | Admin Dashboard')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">
<style>
    .dropdown-menu{
        transform: translate3d(5px, 35px, 0px)!important;
    }
</style>
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Attendances</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admissions Reports</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Edit Attendance Status -->
        <form method="post">
            <div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalCenterTitle">Edit Attendance</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="" id="attendance_id">
                      <label for="">Status</label>
                      <select name="attendance_status" id="attendance_status" class="form-control">
                        <option value="" disabled selected>Choose Option</option>
                        {{-- @foreach ($attendanceStatuses as $attendanceStatus)
                            <option value="{{ $attendanceStatus->id }}">{{ $attendanceStatus->symbol }}</option>
                        @endforeach --}}
                      </select>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button id="saveBtn" type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
        </form>

        <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Admissions Reports</h3>
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
                  <form id="mark-attandance-form" method="post" action="{{ route('admin.class.students') }}" id="quickForm" novalidate="novalidate">
                    @csrf
                    <div class="card-body">
                    <div class="row">
                        <div style="width: 50%; height: 50%; float:left; border: 1px solid black">

                            <div class="container mt-3 mb-3">
                                <h3><b>Filter</b></h3>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <span>Status</span>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="checkbox" name="status" class=""> Current
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" name="status" class=""> Waiting
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" name="status" class=""> Leaved
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" name="status" class=""> Graduated
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <span>Class</span>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="class" class="form-control selectpicker" data-live-search="true">
                                            <option value="" selected></option>
                                            <option value="9a">9A</option>
                                            <option value="9b">9B</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <span>Gender</span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="radio" name="status" class=""> Male
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="radio" name="status" class=""> Female
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <span>FSM</span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="radio" name="status" class=""> Yes
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="radio" name="status" class=""> No
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <span>EAL</span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="radio" name="status" class=""> Yes
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="radio" name="status" class=""> No
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <span>SEN</span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="radio" name="status" class=""> Yes
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="radio" name="status" class=""> No
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <span>Lives with</span>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="class" class="form-control selectpicker" data-live-search="true">
                                            <option value="" selected></option>
                                            <option value="9a">Mum</option>
                                            <option value="9b">Dad</option>
                                            <option value="">Both</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div style="width: 50%; height: 50%; float:right; border: 1px solid black">

                            <div class="container mt-3 mb-4">
                                <h3><b>Show</b></h3>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="checkbox" name="status" checked class=""> Yes
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>General Details</label>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="checkbox" name="status" class=""> Yes
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Additonal Details</label>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="checkbox" name="status" class=""> Yes
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Parent Contact Details</label>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="checkbox" name="status" class=""> Yes
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Emergency Contact Details</label>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="checkbox" name="status" class=""> Yes
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Health Details</label>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="checkbox" name="status" class=""> Yes
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Previous and New School Details</label>
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-bottom: 36px">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="checkbox" name="status" class=""> Yes
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Parental Consents</label>
                                    </div>
                                </div>
                            </div>

                            <br><br>
                        </div>

                    </div>

                    </div>

                    </div>

                  </form>
                </div>

                </div>

            </div>
            <!-- /.row -->
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker({
            nonSelectedText: 'no'
        })
    });
</script>
@endsection
