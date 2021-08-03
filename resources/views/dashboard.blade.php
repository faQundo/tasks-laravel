@extends('layouts.app')

@section('content')


    <style>
        body {
            margin-top: 40px;
            background: #eee;
        }

        .page-todo .tasks {
            background: #fff;
            padding: 0;
            border-right: 1px solid #d1d4d7;
            margin: auto;
        }

        .page-todo .header-button {
            text-align: right;
        }

        .page-todo .task-list {
            padding: 30px 15px;
            height: 100%
        }

        .page-todo .graph {
            height: 100%
        }

        .page-todo .priority.high {
            background: #f3bdbd;
            margin-bottom: 1px
        }

        .page-todo .priority.high span {
            background: #f86c6b;
            padding: 2px 10px;
            color: #fff;
            display: inline-block;
            font-size: 12px
        }

        .page-todo .priority.low {
            background: #cfedda;
            margin-bottom: 1px
        }

        .page-todo .priority.low span {
            background: #4dbd74;
            padding: 2px 10px;
            color: #fff;
            display: inline-block;
            font-size: 12px
        }

        .page-todo .task {
            border-bottom: 1px solid #e4e5e6;
            margin-bottom: 1px;
            position: relative
        }

        .page-todo .no-tasks {
            text-align: center
        }

        .page-todo .action {
            margin: auto;
            text-align: center
        }

        .page-todo .action-element-container {
            display: flex;
        }

        .page-todo .action-element-container form {
            margin: auto;
        }

        .page-todo .action-element {
            color: #3490dc
        }

        .page-todo .task .desc {
            display: inline-block;
            /* width: 75%; */
            padding: 10px 10px;
            font-size: 12px
        }

        .page-todo .task .desc .title {
            font-size: 13px;
            margin-bottom: 5px
        }



        .page-todo .task.last {
            border-bottom: 1px solid transparent
        }

        .page-todo .task.high {
            border-left: 2px solid #f86c6b
        }

        .page-todo .task.medium {
            border-left: 2px solid #f8cb00
        }

        .page-todo .task.low {
            border-left: 2px solid #4dbd74
        }

        .page-todo .timeline {
            width: auto;
            height: 100%;
            margin: 20px auto;
            position: relative
        }

        .page-todo .timeline:before {
            position: absolute;
            content: '';
            height: 100%;
            width: 4px;
            background: #d1d4d7;
            left: 50%;
            margin-left: -2px
        }

        .page-todo .timeslot {
            display: inline-block;
            position: relative;
            width: 100%;
            margin: 5px 0
        }

        .page-todo .timeslot .task {
            position: relative;
            width: 44%;
            display: block;
            border: none;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box
        }

        .page-todo .timeslot .task span {
            border: 2px solid #63c2de;
            background: #e1f3f9;
            padding: 5px;
            display: block;
            font-size: 11px
        }

        .page-todo .timeslot .task span span.details {
            font-size: 16px;
            margin-bottom: 10px
        }

        .page-todo .timeslot .task span span.remaining {
            font-size: 14px
        }

        .page-todo .timeslot .task span span {
            border: 0;
            background: 0 0;
            padding: 0
        }

        .page-todo .timeslot .task .arrow {
            position: absolute;
            top: 6px;
            right: 0;
            height: 20px;
            width: 20px;
            border-left: 12px solid #63c2de;
            border-top: 12px solid transparent;
            border-bottom: 12px solid transparent;
            margin-right: -18px
        }

        .page-todo .timeslot .task .arrow:after {
            position: absolute;
            content: '';
            top: -12px;
            right: 3px;
            height: 20px;
            width: 20px;
            border-left: 12px solid #e1f3f9;
            border-top: 12px solid transparent;
            border-bottom: 12px solid transparent
        }

        .page-todo .timeslot .icon {
            position: absolute;
            border: 2px solid #d1d4d7;
            background: #2a2c36;
            -webkit-border-radius: 50em;
            -moz-border-radius: 50em;
            border-radius: 50em;
            height: 30px;
            width: 30px;
            top: 0;
            left: 50%;
            margin-left: -17px;
            color: #fff;
            font-size: 14px;
            line-height: 30px;
            text-align: center;
            text-shadow: none;
            z-index: 2;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box
        }

        .page-todo .timeslot .time {
            background: #d1d4d7;
            position: absolute;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            top: 1px;
            left: 50%;
            padding: 5px 10px 5px 40px;
            z-index: 1;
            margin-top: 1px
        }

        .page-todo .timeslot.alt .task {
            margin-left: 56%;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box
        }

        .page-todo .timeslot.alt .task .arrow {
            position: absolute;
            top: 6px;
            left: 0;
            height: 20px;
            width: 20px;
            border-left: none;
            border-right: 12px solid #63c2de;
            border-top: 12px solid transparent;
            border-bottom: 12px solid transparent;
            margin-left: -18px
        }

        .page-todo .timeslot.alt .task .arrow:after {
            top: -12px;
            left: 3px;
            height: 20px;
            width: 20px;
            border-left: none;
            border-right: 12px solid #e1f3f9;
            border-top: 12px solid transparent;
            border-bottom: 12px solid transparent
        }

        .page-todo .timeslot.alt .time {
            top: 1px;
            left: auto;
            right: 50%;
            padding: 5px 40px 5px 10px
        }

        @media only screen and (min-width:992px) and (max-width:1199px) {
            .page-todo .task .desc {
                display: inline-block;
                width: 70%;
                padding: 10px 10px;
                font-size: 12px
            }

            .page-todo .task .desc .title {
                font-size: 12px;
                margin-bottom: 5px
            }

        }

        @media only screen and (min-width:768px) and (max-width:991px) {
            .page-todo .task {
                margin-bottom: 1px
            }

            .page-todo .task .desc {
                display: inline-block;
                width: 65%;
                padding: 10px 10px;
                font-size: 10px;
                margin-right: -20px
            }

            .page-todo .task .desc .title {
                font-size: 14px;
                margin-bottom: 5px
            }


            .page-todo .timeslot .task span {
                padding: 5px;
                display: block;
                font-size: 10px
            }

            .page-todo .timeslot .task span span {
                border: 0;
                background: 0 0;
                padding: 0
            }

            .page-todo .timeslot .task span span.details {
                font-size: 14px;
                margin-bottom: 0
            }

            .page-todo .timeslot .task span span.remaining {
                font-size: 12px
            }
        }

        @media only screen and (max-width:767px) {
            .page-todo .tasks {
                position: relative;
                margin: 0 !important
            }

            .page-todo .graph {
                position: relative;
                margin: 0 !important
            }

            .page-todo .task {
                margin-bottom: 1px
            }

            .page-todo .task .desc {
                display: inline-block;
                width: 65%;
                padding: 10px 10px;
                font-size: 10px;
                margin-right: -20px
            }

            .page-todo .task .desc .title {
                font-size: 14px;
                margin-bottom: 5px
            }


            .page-todo .timeslot .task span {
                padding: 5px;
                display: block;
                font-size: 10px
            }

            .page-todo .timeslot .task span span {
                border: 0;
                background: 0 0;
                padding: 0
            }

            .page-todo .timeslot .task span span.details {
                font-size: 14px;
                margin-bottom: 0
            }

            .page-todo .timeslot .task span span.remaining {
                font-size: 12px
            }
        }

    </style>

    <div class="container page-todo bootstrap snippets bootdeys">
        <div class="col-sm-7 tasks">
            <div class="task-list">
                <h1>Tasks</h1>
                <div class="header-button pb-1">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                        data-whatever="Create new task">
                        <span class="material-icons" style="font-size: 0.9rem;">
                            add
                        </span>
                        <span>
                            Add task
                        </span>
                    </button>
                </div>
                @include('partial.alerts')
                {{-- Tasks overdue --}}
                @if ($tasks->isNotEmpty())
                    <div class="priority high"><span>overdue</span></div>
                    @foreach ($tasks as $task)
                        <div class="task high  row" style="margin-right: 0px;margin-left: 0px; display: flex;">
                            <div class="col-8 desc">
                                <div type="button" class="title"><b>Author:</b>
                                    {{ isset($task->creator) ? $task->creator->name : '' }}</div>
                                <div type="button" class="title"><b>Designate:</b>
                                    {{ isset($task->designate) ? $task->designate->name : '' }}</div>
                                <div class="title">
                                    <b>Description:</b> {{ $task->description }}
                                </div>
                            </div>
                            <div class="col desc">
                                <div class="date">{{ $task->date }}</div>
                                <div> 1 day</div>
                            </div>
                            <div class="col action">
                                <div class="action-element-container">
                                    @if (Auth::user()->id == $task->user_designated_id)
                                        <span type="button" class="material-icons action-element" data-toggle="modal"
                                            data-target="#logModal{{$task->id}}" data-whatever="@getbootstrap" data-toggle="tooltip"
                                            data-placement="top" title="Edit">
                                            edit
                                        </span>
                                    @endif
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                        @csrf
                                        @method('DELETE')
                                        <span type="submit" class="destroy-submit material-icons action-element"
                                            data-toggle="tooltip" data-placement="top" title="Delete">
                                            delete
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL LOG --}}
                        <div class="modal fade bd-example-modal-lg" id="logModal{{$task->id}}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New log</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('logs.store') }}">
                                        @csrf
                                        <div class="modal-body">
                                            @foreach ($task->logs as $log)
                                                <div
                                                    class="d-flex pb-2 {{ $log->creator->id == Auth::user()->id ? 'flex-row-reverse' : 'flex-row' }}">
                                                    <div class="card w-50">
                                                        <div class="card-header">
                                                            <div>
                                                                <span>
                                                                    Author:
                                                                    {{ isset($log->creator) ? $log->creator->name : '-' }}
                                                                </span>
                                                                <span style="margin-left: 30px">
                                                                    {{ $log->date }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                Message: {{ isset($log->comment) ? $log->comment : '-' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Commentary:</label>
                                                <textarea class="form-control" name="comment"></textarea>
                                            </div>

                                            <div class="form-group" hidden>
                                                <input class="form-control" name="taskId" value="{{$task->id}}">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Send message</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- Tasks upcoming --}}
                @if ($tasksOverdue->isNotEmpty())
                    <div class="priority low"><span>upcoming</span></div>
                    @foreach ($tasksOverdue as $task)
                        <div class="task low  row" style="margin-right: 0px;margin-left: 0px; display: flex;">
                            <div class="col-8 desc">
                                <div type="button" class="title"><b>Author:</b>
                                    {{ isset($task->creator) ? $task->creator->name : '' }}</div>
                                <div type="button" class="title"><b>Designate:</b>
                                    {{ isset($task->designate) ? $task->designate->name : '' }}</div>
                                <div class="title">
                                    <b>Description:</b> {{ $task->description }}
                                </div>
                            </div>
                            <div class="col desc">
                                <div class="date">{{ $task->date }}</div>
                                <div> 1 day</div>
                            </div>
                            <div class="col action">
                                <div class="action-element-container">
                                    @if (Auth::user()->id == $task->user_designated_id)
                                        <span type="button" class="material-icons action-element" data-toggle="modal"
                                            data-target="#logModal{{$task->id}}" data-whatever="@getbootstrap" data-toggle="tooltip"
                                            data-placement="top" title="Edit">
                                            edit
                                        </span>
                                    @endif
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                        @csrf
                                        @method('DELETE')
                                        <span type="submit" class="destroy-submit material-icons action-element"
                                            data-toggle="tooltip" data-placement="top" title="Delete">
                                            delete
                                        </span>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL LOG --}}
                        <div class="modal fade bd-example-modal-lg" id="logModal{{$task->id}}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New log</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('logs.store') }}">
                                        @csrf
                                        <div class="modal-body">
                                            @foreach ($task->logs as $log)
                                                <div
                                                    class="d-flex pb-2 {{ $log->creator->id == Auth::user()->id ? 'flex-row-reverse' : 'flex-row' }}">
                                                    <div class="card w-50">
                                                        <div class="card-header">
                                                            <div>
                                                                <span>
                                                                    Author:
                                                                    {{ isset($log->creator) ? $log->creator->name : '-' }}
                                                                </span>
                                                                <span style="margin-left: 30px">
                                                                    {{ $log->date }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                Message: {{ isset($log->comment) ? $log->comment : '-' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Commentary:</label>
                                                <textarea class="form-control" name="comment"></textarea>
                                            </div>

                                            <div class="form-group" hidden>
                                                <input class="form-control" name="taskId" value="{{$task->id}}">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Send message</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach


                @endif
                @if ($tasks->isEmpty() && $tasksOverdue->isEmpty())
                    <div class="no-tasks">
                        <p class="text-muted">Tasks empty</p>
                    </div>
                @endif
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    {{-- MODAL CREATE TASK --}}
    <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create new task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">User designed:</label>
                            <select class="form-select form-control" aria-label="Default select example"
                                name="user_designated_id">
                                <option selected>Designate user</option>
                                @if (isset($users))
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Description:</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Due date:</label>
                            <input type="date" class="form-control" name="date"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE LOG --}}
    {{-- <div class="modal fade bd-example-modal-lg" id="logModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New log</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('logs.store' ) }}">
                    @csrf
                    <div class="modal-body">
                        @foreach ($logs as $log)
                            <div class="d-flex pb-2 {{$log->creator->id == Auth::user()->id ? 'flex-row-reverse' : 'flex-row'}}">
                                <div class="card w-50">
                                    <div class="card-header">
                                        <div>
                                            <span>
                                                Author: {{ isset($log->creator) ? $log->creator->name : '-' }}
                                            </span>
                                            <span style="margin-left: 30px">
                                                {{$log->date}}
                                            </span>
                                        </div>
                                        <div>
                                            Message: {{ isset($log->comment) ? $log->comment : '-'}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Commentary:</label>
                            <textarea class="form-control" name="comment"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send message</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection

@push('bottom')
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text(recipient)
            modal.find('.modal-body input').val(recipient)
        });
        $('.destroy-submit').click(function() {
            $(this).parents('form').submit();
        })
    </script>
@endpush
