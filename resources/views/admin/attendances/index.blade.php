@extends('layouts.admin')

@section('title', 'Attendances | Admin Dashboard')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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
              <li class="breadcrumb-item"><a href="#">Attendances</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="card card-primary card-outline">

        <div class="card-header">
          <h4>Attendances</h4>
        </div>

        <div class="modal" id="ajaxModal">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Attendance Detail</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <form id="modal-form">

                  <input type="hidden" name="attendance_id" id="attendance_id">

                  <div class="form-group">
                    <label for="">Class <span style="color:red;"> *</span></label>
                    <select name="class" id="attendance_class" class="form-control">
                        <option value="" disabled selected>Choose Option</option>
                        @if (count($classes) > 0)
                            @foreach ($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        @endif
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="">Status</label>
                    <select name="attendance_symbol" id="attendance_symbol" class="form-control">
                      @if (count($attendanceStatuses) > 0)
                          @foreach ($attendanceStatuses as $status)
                              <option value="{{ $status->id }}">{{ $status->symbol }}</option>
                          @endforeach
                      @endif
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="">Time</label>
                    <select name="attendance_time" id="attendance_time" class="form-control">
                      <option value="" disabled selected>Choose Option</option>
                      <option value="am">Am</option>
                      <option value="pm">Pm</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="attendance_date" id="attendance_date" class="form-control">
                  </div>


                  <div class="form-group">
                    <label for="">Note</label>
                    <textarea name="attendance_note" id="attendance_note" cols="3" rows="3" class="form-control" placeholder="Enter note here..."></textarea>
                  </div>

                </form>
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="updateBtn" class="btn btn-info">Save Changes</button>
              </div>

            </div>
          </div>
        </div>

        <br>

         <form method="get" action="{{ route('admin.attendances.index') }}">
          <div class="container">
            <div class="row">

            <div class="col-md-3">
                <label for="">Class <span style="color:red;"> *</span></label>
                <select name="class" id="class" class="form-control showAttendanceDropdwon">
                    <option value="" disabled selected>Choose Option</option>
                    @if (count($classes) > 0)
                        @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    @endif
                </select>
                </div>


              <div class="col-md-3">
                <label for="">Date <span style="color:red;"> *</span></label>
                <input type="date" name="date" id="date" class="form-control">
              </div>

              <div class="col-md-3">
                <label for="">Time <span style="color:red;"> *</span></label>
                <select name="time" id="time" class="form-control">
                  <option value="" disabled selected>Choose Option</option>
                  <option value="am">Am</option>
                  <option value="pm">Pm</option>
                </select>
              </div>

              <div class="col-md-3">
                <label for="">Student Name <span style="color:red;"> *</span></label>
                <select name="student_name" id="student_name_select" class="form-control">
                  <option value="" disabled selected>Choose Option</option>
                </select>
              </div>

            </div>

            <div class="row mt-3" style="float: right">
              <div class="col-md-12">
                <button type="submit" class="btn btn-info ml-2">Submit</button>
              </div>
            </div>

          </div>
         </form>

          <br>

        <div class="card-body">
          <table id="example" class="table table-bordered table-striped example1">
            <thead>
              <tr>
                <th>Student Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Note</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @isset($studentAttendances)
                @if (count($studentAttendances) > 0)
                    @foreach ($studentAttendances as $attendance)
                        <tr>
                          <td>{{ $attendance->student->surname. '' .$attendance->student->middlename. ' '.$attendance->student->forename }}</td>
                          <td>{{ $attendance->date }}</td>
                          <td>{{ $attendance->time }}</td>
                          <td>{{ $attendance->status->symbol }}</td>
                          <td>{{ Str::limit($attendance->note, 15) }}</td>
                          <td>
                            <a href="#" data-id="{{ $attendance->id }}" title="Edit" class="btn btn-info editButton"><i class="fas fa-edit"></i></a>
                          </td>
                        </tr>
                    @endforeach
                @endif
              @endisset
            </tbody>
            <tfoot>
              <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Note</th>
                <th>Actions</th>
              </tr>
            </tfoot>
          </table>
        </div>

    </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>

<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
  $(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var allAttendance = "{{ isset($studentAttendances) }}";

    if (allAttendance == false) {
      var table = $("#example").DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('admin.attendances.index') }}",
              columns: [
                  {data: 'student'},
                  {data: 'date'},
                  {data: 'time'},
                  {data: 'status'},
                  {data: 'note'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
      });
    }
    else {
      var table = $("#example").DataTable();
    }


    // Deleting Bet Type
    $('body').on('click', '.editButton', function () {

    var attendanceId = $(this).data("id");

    // console.log

      $.ajax({
        type: "GET",
        url: "{{ url('admin/attendances') }}" +'/'+ attendanceId + '/edit',
        success: function (data) {
          $("#ajaxModal").modal('show');
          $('#attendance_id').val(data.id);
          $('#attendance_note').val(data.note);
          $("#attendance_date").val(data.date);
          $("#attendance_time").val(data.time);

          if($("#attendance_symbol option[value='"+data.attendance_status_id+"']").length > 0) {
            $("#attendance_symbol option[value='"+data.attendance_status_id+"']").remove()
          }

          $('#attendance_symbol').append($('<option>', {
              value: data.attendance_status_id,
              text : data.symbol
          }));

          if($("#attendance_class option[value='"+data.attendance_class_id+"']").length > 0) {
            $("#attendance_class option[value='"+data.attendance_class_id+"']").remove()
          }

          $('#attendance_class')
          .append($('<option>', {
              value: data.attendance_class_id,
              text : data.attendance_class_name,
              selected: 'selected'
          }));

        },
        error: function (data) {

            if(data.error){
              toastr['error'](data.error)
            }
            else {
              toastr['error']('Something went wrong, please refresh webpage and try again.')
            }
        }
      });

    });



    // Update Attendance
  $('body').on('click', '#updateBtn', function () {

  var attendanceId = $('#attendance_id').val();

  var attendance_time = $("#attendance_time").val();
  var attendance_note = $("#attendance_note").val();
  var attendance_symbol = $("#attendance_symbol").val();
  var attendance_date = $("#attendance_date").val();
  var attendance_class = $("#attendance_class").val();


  $.ajax({
    type: "PATCH",
    url: "{{ route('admin.attendances.update', '') }}" +'/'+ attendanceId,
    data: { attendance_time, attendance_date, attendance_note, attendance_symbol, attendance_class },
    success: function (data) {

      window.location.href = "{{ route('admin.attendances.index') }}";
      $('#ajaxModal').modal('hide');
      toastr['info'](data.success)
    },
    error: function (data) {

        if(data.error){
          toastr['error'](data.error)
        }
        else {
          toastr['error']('Something went wrong, please refresh webpage and try again.')
        }
    }
  });

});


  $('.showAttendanceDropdwon').change(function() {
    $('#student_name_select').empty();
    $('#student_name_select').append('<option>Choose Option</option>', {
      value: '',
      disabled: 'disabled',
      selected: 'selected'
    });
    var class_id = this.value;

    $.ajax({
      type: "GET",
      url: "{{ route('admin.students.fetch') }}",
      data: { class_id },
      success: function (data) {

        $.each(data , function (key, value) {
          $('#student_name_select').append($('<option>',
         {
              value: value.id,
              text: value.surname +' '+ value.middlename == null ? value.middlename: '' +' '+ value.forename
          }));
        });
      },
      error: function (data) {

          if(data.error){
            toastr['error'](data.error)
          }
          else {
            toastr['error']('Something went wrong, please refresh webpage and try again.')
          }
      }
    });

  });


  });

</script>
@endsection
