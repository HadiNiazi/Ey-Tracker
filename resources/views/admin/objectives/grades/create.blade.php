@extends('layouts.admin')

@section('title', 'Grades | Admin Dashboard')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<style>
    #input-style {
        border-width:0px;
        border:none;
        outline:none;
    }
    .primary-bg-color {
        background-color: #006A9E;
        color: #ffffff;
    }
    .text-font {
        /* font-family: 'Quatro Slab', 'Regular' !important; */
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
            <h1 class="text-font">Grades</h1>
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
                <div class="card">
                  <div class="card-header" style="background-color: #006A9E; color: white">
                    <h3 class="card-title text-font">Enter Grade</h3>
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
                  <form action="{{ route('admin.objectives.grades.create') }}">
                  {{-- <form method="post" action="{{ route('admin.objectives.grades.store') }}" id="quickForm"> --}}
                    <div class="card-body">
                      <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label text-font">Class<span style="color:red;"> *</span> </label>
                                <select name="class" id="class" class="selectpicker form-control" data-live-search="true">
                                  <option value="" disabled selected>Choose Option</option>
                                  @if (count($classes) > 0)
                                      @foreach ($classes as $class)
                                          <option @selected($class->id == request()->class) value="{{ $class->id }}">{{ $class->name }}</option>
                                      @endforeach
                                  @endif
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label text-font">Topic<span style="color:red;"> *</span> </label>
                                <select name="main_objective" id="main_objective" class="selectpicker form-control" data-live-search="true">
                                  <option value="" disabled selected>Choose Option</option>
                                  @if (count($mainObjectives) > 0)
                                      @foreach ($mainObjectives as $objective)
                                          <option @selected($objective->id == request()->main_objective) value="{{ $objective->id }}">{{ $objective->name }}</option>
                                      @endforeach
                                  @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label text-font">Sub Topic <span style="color:red;"> *</span> </label>
                                <select name="sub_objective" id="sub_objective" class="selectpicker form-control" data-live-search="true">
                                    <option value="" disabled selected>Choose Option</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label text-font">Objectives<span style="color:red;"> *</span> </label>
                                <select name="objective" id="objective" class="selectpicker form-control" data-live-search="true">
                                    <option value="" disabled selected>Choose Option</option>
                                </select>
                            </div>
                        </div>

                      </div>

                      <div class="row">
                        <button type="submit" class="btn primary-bg-color text-font">Show Results</button>
                      </div>
                  </form>

                  <form id="attendance_form" method="post" action="{{ route('admin.objectives.grades.store') }}" class="mt-5">
                    @csrf

                    <input type="hidden" name="class_id" value="{{ request()->class }}">
                    <input type="hidden" name="main_objective_id" value="{{ request()->main_objective }}">
                    <input type="hidden" name="sub_objective_id" value="{{ request()->sub_objective }}">
                    <input type="hidden" name="objective_id" value="{{ request()->objective }}">

                <div id="objectives-table">
                    <table class="table table-bordered text-font">
                        <thead style="background-color: #17AF95; color: #ffffff">
                            <th>S. No</th>
                            <th>Student Name</th>
                            <th >Objective Status</th>
                            <th class="text-center">Date</th>
                        </thead>
                        <tbody>
                            @php $count = 1; @endphp
                            @if (count($studentDetails) > 0)
                                @foreach ($studentDetails as $studentDetail)
                                <tr>
                                    @if ($studentDetail->student)
                                        <td style="width: 5%;">{{ $count++ }}</td>
                                        <input type="hidden" name="student_ids[]" class="form-control" value="{{ $studentDetail->student->id }}">
                                        <td style="width: 40%"><input type="text" name="student_name" id="input-style" class="form-control" value="{{ $studentDetail->student->surname.' '.$studentDetail->student->middlename.''.$studentDetail->student->forename  }}"></td>
                                        <td style="width: 10%;"><input type="checkbox" name="objective_achieved[]" class="form-control" style="width: 20px"></td>
                                        <td style="width: 45%;"><input type="date" name="objective_achieved_date[]" class="form-control" id="input-style"></td>
                                    @endif
                                </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>

                    <button class="btn primary-bg-color text-font">Submit</button>
                  </div>
                </form>

                  </div>

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

        $('#objectives-table').hide();

        const urlParams = window.location.search;
        const sub_objective = urlParams.split('&')[3];

        if (sub_objective) {
            $('#objectives-table').show();
        }

        // if ()

        $('#main_objective').change(function() {

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

            var class_id = $('#class').val();

            if (! class_id) {
                toastr["error"]('Please select your class');
            }

            $('#objective').empty();
            $("<option/>", {
                value: '',
                text: 'Choose Option',
                // disabled: 'disabled'
            }).appendTo('#objective');

            $.ajax({
                url: "{{ route('admin.get.objectives', '') }}" + '/' + class_id,
                type: "GET",
                success: function (response) {

                    $.each(response, function(index, value){
                        $("<option/>", {
                            value: value.id,
                            text: value.title
                        }).appendTo('#objective');

                        $('.selectpicker').selectpicker('refresh');

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


        // $('#students').change(function() {
        //     $('#objectives-table').show();
        // });

    });
</script>

@endsection
