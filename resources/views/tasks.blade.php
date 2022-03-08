@extends('layouts.master')

@section('title') Todo | Home @endsection

@push('extra-styles')
    <link href="{{ asset('assets/css/addons/datatables.min.css') }}" rel="stylesheet">
    <style>
        .required{
            color:red;
        }
    </style>
@endpush

@section('content')
    @include('layouts.messages')
    
    <section class="vh-100 gradient-custom-2">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-12 col-xl-12">
                    <div class="card rounded-3">
                        <div class="card-body p-4">
                            
                            <h4 class="my-3 pb-3"><i class="fas fa-clipboard-list"></i> To Do Application</h4>

                            <form class="cmxform" method="POST" action="{{ route('task.store','task') }}">
                                @csrf
                                <input type="hidden" name="timezone" id="timezone">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-outline">
                                            <input type="text" id="name" name="name" class="form-control" required>
                                            <label class="form-label" for="name">Enter task name <span class="required">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-outline">
                                            <input type="text" id="description" name="description" class="form-control" required>
                                            <label class="form-label" for="description">Enter task name <span class="required">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-outline datetimepicker-inline">
                                            <input id="deadline" name="deadline" type="text" class="form-control" required>
                                            <label for="deadline" class="form-label">Select Date and Time <span class="required">*</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="padding-top: 10px;">
                                    <div class="col-md-12" >
                                        <button type="submit" class="form-control btn btn-primary">Add Task</button>
                                    </div>
                                </div>
                            </form>

                            <hr>
                            <div id="time"></div>
                            <div class="card-header p-3" style="margin-top: 5%;">
                                <h5 class="mb-0"><i class="fas fa-tasks me-2"></i> Task List</h5>
                            </div>

                                                        
                            <div class="datatable text-center">
                                <table id="tasks-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="th-sm">Task Name</th>
                                            <th class="th-sm">Task Description</th>
                                            <th class="th-sm">Task Status</th>
                                            <th class="th-sm">Task Deadline</th>
                                            <th class="th-sm">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($tasks as $task)
                                            <tr>
                                                <td># {{$task->task_name}}</td>
                                                <td>{{$task->task_description}}</td>
                                                <td>
                                                    @if($task->status === 1)
                                                        <h6 class="mb-0"><span class="badge bg-danger">Finished</span></h6>
                                                    @else 
                                                        <h6 class="mb-0"><span class="badge bg-success">Active</span></h6>
                                                    @endif
                                                </td>

                                                <td>
                                                    <label class="timezone d-none">{{ $task->timezone }}</label>
                                                    <label class="deadline">{{ $task->deadline }}</label>
                                                    {{--  {{ $task->deadline }}  --}}
                                                    {{--  @displayDate($task->deadline)  --}}
                                                    {{--  {{ Timezone::convertToLocal($task->created_at, 'Y-m-d g:i', true) }}  --}}
                                                    {{--  {{ Timezone::convertToLocal($task->created_at) }}  --}}
                                                    {{--  {{$task->deadline_date.' '.$task->deadline_time}}  --}}
                                                </td>
                                                <td>
                                                    @if($task->status === 1)
                                                        <h6 class="mb-0">Task Finished</span></h6>
                                                    @else
                                                        <a href="{{ route('task.done', ['id' => $task->id]) }}" name="done" class="btn btn-warning ms-1"> Finish <i class="fas fa-check"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('extra-scripts')
    <!-- DataTables JS -->
    <script src="{{ asset('assets/js/addons/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/moment-timezone.js') }}" type="text/javascript"></script>
    
    <script>
        // Material Design example
        $(document).ready(function () {
            $('#timezone').val(moment.tz.guess())
            $('#tasks-table').DataTable();
            $('#tasks-table').find('label').each(function () {
                $(this).parent().append($(this).children());
            });
            $('#tasks-table .dataTables_filter').find('input').each(function () {
                const $this = $(this);
                $this.attr("placeholder", "Search");
                $this.removeClass('form-control-sm');
            });
            $('#tasks-table .dataTables_length').addClass('d-flex flex-row');
            $('#tasks-table .dataTables_filter').addClass('md-form');
            $('#tasks-table select').removeClass('custom-select custom-select-sm form-control form-control-sm');
            $('#tasks-table select').addClass('mdb-select');
            $('#tasks-table .dataTables_filter').find('label').remove();

            var deadline    = $('.deadline').text();
            var m           = moment.utc(deadline, "YYYY-MM-DD h:mm:ss A"); // parse input as UTC

            var tz = moment.tz.guess();
            $('.deadline').text(m.clone().tz(tz).format("YYYY-MM-DD h:mm:ss A"));
        });

        const pickerInline = document.querySelector('.datetimepicker-inline');
        const datetimepickerInline = new mdb.Datetimepicker(pickerInline, { 
            inline: true ,
        });
    </script>

@endpush