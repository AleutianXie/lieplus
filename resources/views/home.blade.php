@extends('layouts.cici')

@section('content')
{{-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}

<table id="users-table" class="table table-condensed">
    <caption class="alert alert-success">
        <p>
            <strong>IMPORTANT: </strong>When using <strong>make()</strong>, the package will rely filtering and sorting based on the index/arrangement of your select query.
        </p>
        <br>
        <p>
            <strong>NEVER USE SELECT(*)</strong> when using this approach or your DataTables filtering/sorting may not work properly.
        </p>
    </caption>
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>

@endsection

@section('scripts')
<link rel="stylesheet" href="{{ asset('static/css/bootstrap-editable.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/ace.min.css') }}" />
<link rel="stylesheet" href="{{ asset('static/css/dataTables.bootstrap.min.css') }}" />

<!-- page specific plugin scripts -->

<script src="{{ asset('static/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('static/js/jquery.dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('static/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('static/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('static/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('static/js/bootstrap-editable.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('home.get') }}',
            columns: [
                {data:'id'},
                {data:'name'},
                {data:'email'},
                {data:'created_at'},
                {data:'updated_at'}
        ]
        });
    });
</script>
@endsection
