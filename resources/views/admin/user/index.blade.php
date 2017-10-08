@extends('layouts.cici')

@section('title'){{ $title }}@endsection

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('static/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
                <div>
                    <div class="panel panel-default">
                        <div class="panel-heading">用户列表</div>

                        <div class="panel-body">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>{{ __('auth.name') }}</th>
                                        <th>{{ __('auth.email') }}</th>
                                        <th>{{ __('lieplus.department') }}</th>
                                        <th>{{ __('lieplus.role') }}</th> 
                                    </tr> 
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td><a href="{{ asset('/user/'.$user->id) }}">{{ $user->name }}</a></td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                        @isset ($user->profile->department->name)
                                            {{ $user->profile->department->name }}
                                        @endisset
                                        </td>
                                        <td>@foreach ($user->getRoleNames() as $role)
                                            {{ __('lieplus.roles.'.$role) }} &nbsp;
                                        @endforeach</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Indicates a successful or positive action -->
                            <div class="pull-right">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('admin') !!}
@endsection