@extends('layouts.admin.master')

@section('content')

<h3>users</h3>

<table id="user_table" class="display">
        
    <thead>
        <tr>
                <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Title</th>
            <th>Phone</th>
        </tr>
    </thead>
    {{-- @foreach($users as $user)
    <tbody>
        <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td> 
        </tr>
        
    </tbody>
    @endforeach --}}
</table>



@endsection

@section('scripts')

function format ( d ) {
if(d.profile=null) {
    d.profile="" }
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<td>Full name:</td>'+
                '<td>'+d.name+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Email:</td>'+
                '<td>'+d.email+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Company:</td>'+
                '<td>'+d.profile.company+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Title:</td>'+
                '<td>'+d.profile.title+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Phone:</td>'+
                '<td>'+d.profile.phone+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Address:</td>'+
                '<td>'+d.profile.address+'</td>'+
            '</tr>'+
        '</table>';

    
}

axios.get('/admin/user/api')
    .then(res=>{
        var newdata = res.data;
        $(document).ready( function () {
             table = $('#user_table').DataTable(
                {
                    data:newdata,
                    columns: [
                        {
                            "className":      'details-control',
                            "orderable":      false,
                            "data":           null,
                            "defaultContent": 'view'
                        },
                        { data: 'name' },
                        { data: 'email' },
                        { data: 'profile.company',
                        "defaultContent": "<i>Not set</i>" },
                        { data: 'profile.title',
                        "defaultContent": "<i>Not set</i>" },
                        { data: 'profile.phone',
                        "defaultContent": "<i>Not set</i>" },
                    ],
                    dom: 'frtipB',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf'
                    ]

                }
            );
        } );

        $('#user_table tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');

            var row = table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        } );
    })
    .catch(function(err){
        console.log(err);
    });
 

@stop