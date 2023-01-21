@extends('layouts.admin')

@section('title', 'New Admission | Admin Dashboard')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
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
                    <h3 class="card-title">Add Grade</h3>
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
                  <form method="post" action="#" id="quickForm">
                    @csrf
                    <div class="card-body">
                      <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">Objective <span style="color:red;"> *</span> </label>
                                <select name="objective" id="objective" class="selectpicker form-control" data-live-search="true">
                                  <option value="" disabled selected>Choose Option</option>
                                  @if (count($objectives) > 0)
                                      @foreach ($objectives as $objective)
                                          <option value="{{ $objective->id }}">{{ $objective->name }}</option>
                                      @endforeach
                                  @endif
                                </select>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">Sub Objective <span style="color:red;"> *</span> </label>
                                <select name="sub_objective" id="sub_objective" class="selectpicker form-control" data-live-search="true">
                                  <option value="" disabled selected>Choose Option</option>
                                </select>
                            </div>
                          </div>


                          <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label">Classes<span style="color:red;"> *</span> </label>
                                <select name="classes" id="classes" class="selectpicker form-control" data-live-search="true">
                                  <option value="" disabled selected>Choose Option</option>
                                </select>
                            </div>
                          </div>

                      </div>
                      <br><br>
                      {{-- <div class="row"> --}}
                        <table class="table table-bordered student-table">
                            <thead>
                                <th>Name</th>
                                <th>DOB</th>
                                <th>Gender</th>
                            </thead>
                            <tbody></tbody>
                        </table>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script>
    $(document).ready(function() {

        $('#objective').change(function() {

            $('#sub_objective').empty();
            $("<option/>", {
                value: '',
                text: 'Choose Option',
                // disabled: 'disabled'
            }).appendTo('#sub_objective');

            var objective_id = this.value;

            $.ajax({
                url: "{{ route('admin.get.sub-objectives') }}",
                type: "GET",
                data: { objective_id },
                success: function (response) {

                    $.each(response, function(index, value){
                        $("<option/>", {
                            value: value.id,
                            text: value.name
                        }).appendTo('#sub_objective');

                        $('.selectpicker').selectpicker('refresh')

                        });

                },
                error: function (error) {
                    toastr["error"]('Something went wrong, please refresh the webpage and try again, if still problem persists, contact with administrator');
                }
            });

        })

        $('#sub_objective').change(function() {

            var sub_objective_id = this.value;

            $('#classes').empty();
            $("<option/>", {
                value: '',
                text: 'Choose Option',
                // disabled: 'disabled'
            }).appendTo('#classes');



            $.ajax({
                url: "{{ route('admin.get.classes') }}",
                type: "GET",
                data: { sub_objective_id },
                success: function (response) {

                    $.each(response, function(index, value){
                        $("<option/>", {
                            value: value.id,
                            text: value.name
                        }).appendTo('#classes');

                        $('.selectpicker').selectpicker('refresh')

                        });

                },
                error: function (error) {

                    if (error.responseJSON) {
                        toastr["error"](error.responseJSON.error);
                    }
                    else {
                       toastr["error"]('Something went wrong, please refresh the webpage and try again, if still problem persists, contact with administrator');
                    }

                }
            });

        });

    });
</script>
<script>
  $(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $(".student-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.objectives.grades.create') }}",
        columns: [
            {data: 'student'},
            {data: 'dob'},
            {data: 'gender'}
        ]
      });

      $('#classes').change(function() {
            var class_id = this.value;
            table.ajax.reload();
            return false;
      });

        table.on('preXhr.dt', function ( e, settings, data ) {
            data.class_id = $('#classes').val();
        });
  });
</script>
@endsection
