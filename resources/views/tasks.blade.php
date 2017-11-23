@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('apps.new_task')
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <!-- New Task Form -->  
                    {{ Form::open(['route' => 'task.store' , 'class' => 'form-horizontal']) }}   
                        <div class="form-group"
                            <i class="fa fa-btn fa-plus"></i>
                                {{ Form::label('task-name' , trans('apps.task'), ['class' => 'col-sm-3 control-label']) }}
                            <br>
                            <div class="col-sm-6">
                                {{ Form::text('name', old('task'), ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                {{ Form::submit(trans('apps.add_task'), ['class' => 'btn btn-default']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($tasks))
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @lang('apps.current_tasks')
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>@lang('apps.task')</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td class="table-text"><div>{{ $task->name }}</div></td>
                                        <!-- Task Delete Button -->
                                        <td>
                                            {{ Form::open(['route' => ['task.destroy', $task->id] , 'method' => 'DELETE']) }}
                                                {{ Form::submit(trans('apps.delete') , ['class' => 'btn btn-danger']) }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
@endsection

