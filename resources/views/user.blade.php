@extends('layouts.admin.master')

@section('content')

<h3>users</h3>

@foreach($users as $user)
<p>{{$user->name}}</p>
@endforeach

<table id="user_table" class="display">
        
    </table>

@endsection

@section('scripts')
    $(document).ready( function () {
        $('#user_table').DataTable({
            serverSide: true,
            ajax: {
                url: '/admin/user',
                type: 'GET'
            }
        });
    } );
@stop