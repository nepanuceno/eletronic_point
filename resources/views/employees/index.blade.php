@extends('adminlte::page')

@section('title', 'Servidores')

@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugins', true)

@section('content_header')
    <h1>{{ __('employee.lable-employees') }}</h1>
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('employees.index') }}
@stop

@section('content')

    @if (session('danger'))
        <div class="alert alert-danger alert-dismiss">
            {{ session('danger') }}
        </div>
    @endif

    <div class="row mb-3">
        <div class="col">
            @can('servidor-create')
                @if (!isset($status) || $status==0)
                    <a class="btn btn-secondary" href="{{ route('employees.create') }}"><span
                            class="fas fa-plus mr-1"></span>{{ __('app.btn-new') }}</a>
                @endif
            @endcan
            <a class="float-right btn {{ !isset($status) || $status == 1 ? 'btn-warning' : 'btn-secondary' }}"
                href="{{ route('employees.index',['status'=>$status]) }}">
                <i class="fas fa-eye mr-2"></i>Mostrar {{ $status == 1 ? 'Ativos' : 'Inativos' }}
            </a>
        </div>
    </div>

    <table id="table-employees" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Funcionário</th>
                <th>Departamento</th>
                <th>Cargo</th>
                <th>Matrícula</th>
                <th>Telefone</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>

@stop

@section('js')
    @if ($message = Session::get('success'))
    @alertSuccess({{ $message }});
    @endif
    <script>
         $(function () {
             console.log(table);
            var table = $('#table-employees').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('list.employees', ['status'=>!$status]) }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'employee', name: 'employee'},
                    {data: 'departament', name: 'departament'},
                    {data: 'responsibility', name: 'responsibility'},
                    {data: 'matriculation', name: 'matriculation'},
                    {data: 'telephone', name: 'telephone'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            // table.destroy();
        });
    </script>
@endsection
