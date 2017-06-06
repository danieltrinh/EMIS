@extends('backpack::layout')

@section('content')
    <?php $user = Auth::user(); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><b style="font-size: 120%"><i class="fa fa-filter" aria-hidden="true"></i>&nbsp;&nbsp;Filter</b></div>
                    <div class="panel-body">
                    @if ($user->hasRole('admin'))
                    <div class="table-responsive">
                    
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Name </th>
                                        {{-- <th> Description </th> --}}
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($levels as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        {{-- <td>{{ $item->description }}</td> --}}
                                        <td>
                                            <a href="{{ url('/admin/levels/' . $item->id) }}" class="btn btn-success btn-xs" title="View Level"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/admin/levels/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Level"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/admin/levels', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="pagination-wrapper"> {!! $levels->render() !!} </div> --}}
                        </div>
                        @endif
                        
                        <form class="form-horizontal">
                            <div class="form-group"  <?php if (!$user->hasRole('admin')) echo 'style="display:none"';?>>
                                <label for="level_id" class="col-md-3 control-label">Level</label>
                                <div class="col-md-6">
                                    <select name="level_id" id="level_id" class="form-control">
                                        @if ($user->hasRole('admin'))
                                            <option value="" >Please choose a level</option>
                                            @foreach($levels as $item)
                                                <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                            @endforeach
                                        @elseif($user->hasRole('principle'))
                                            <?php
                                            $current_school =  getPrincipleSchool($user->id); 
                                            $current_school = \App\School::findOrFail($current_school[0]->id);
                                            ?>
                                            <option value="{{ $current_school->level->id }}" selected>{{ $current_school->level->name }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="form-group" <?php if (!$user->hasRole('admin') && !$user->hasRole('principle')) echo 'style="display:none"';?>>
                                <label for="school_id" class="col-md-3 control-label">School</label>
                                <div class="col-md-6">
                                    <select name="school_id" id="school_id" class="form-control" >
                                        @if ($user->hasRole('principle'))
                                            <?php
                                                $current_school =  getPrincipleSchool($user->id); 
                                                $current_school = \App\School::findOrFail($current_school[0]->id);
                                            ?>
                                            <option value="{{ $current_school->id }}" selected>{{ $current_school->name }}</option>
                                        @elseif ($user->hasRole('teacher'))
                                            <?php
                                                $current_classroom = getTeacherClassroom($user->id);
                                                $current_classroom_id = $current_classroom[0]->id;
                                                $current_classroom = \App\Classroom::findOrFail($current_classroom_id);
                                            ?>
                                            <option value="{{ $current_classroom->school->id }}" selected>{{ $current_classroom->school->name }}</option>
                                        @else
                                            <option value="" ></option>
                                        @endif
                                    </select>
                                        {{-- @endforeach --}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="grade_id" class="col-md-3 control-label">Grade</label>
                                <div class="col-md-6">
                                    <select name="grade_id" id="grade_id" class="form-control">
                                        @if ($user->hasRole('teacher'))
                                            <?php
                                                $current_classroom = getTeacherClassroom($user->id);
                                                $current_classroom_id = $current_classroom[0]->id;
                                                $current_classroom = \App\Classroom::findOrFail($current_classroom_id);
                                            ?>
                                            <option value="{{ $current_classroom->grade->id }}" selected>{{ $current_classroom->grade->name }}</option>
                                        @endif
                                        {{-- @foreach($grades as $item)
                                        <option value="" ></option>
                                        <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="classroom_id" class="col-md-3 control-label">Class</label>
                                <div class="col-md-6">
                                    <select name="classroom_id" id="classroom_id" class="form-control">
                                        <option value="" ></option>
                                        {{-- @foreach($classrooms as $item)
                                        <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </form>
                        {{-- <a href="{{ url('/admin/levels/create') }}" class="btn btn-primary btn-xs" title="Add New Level"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a> --}}
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless all_filter">
                                <thead id="filter_header">
                                    
                                </thead>
                                <tbody id="filter_content">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
