@extends('adminlte::page')

@section('title', 'Servidores')

@section('content_header')
    <h1>Servidores</h1>
@stop

@section('breadcrumb')
    {{ Breadcrumbs::render('employees.index') }}
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismiss">
            {{ session('success') }}
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger alert-dismiss">
            {{ session('danger') }}
        </div>
    @endif

    <div class="row mb-3">
        <div class="col">
            @can('servidor-create')
                @if (session('active') == 1)
                    <a class="btn btn-secondary" href="{{ route('employees.create') }}"><span
                            class="fas fa-plus mr-1"></span>Novo</a>
                @endif
            @endcan
            <a class="float-right btn {{ session('active') == 0 ? 'btn-warning' : 'btn-secondary' }}"
                href="{{ url('set_active') }}">
                <i class="fas fa-eye mr-2"></i>Mostrar {{ session('active') == 0 ? 'Ativos' : 'Inativos' }}
            </a>
        </div>
    </div>
    @if (count($employees) > 0)
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-sm table-striped table-hover table-valign-middle">
                    <thead class="thead-dark ">
                        <tr>
                            <th>Servidores</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            @can(['servidor-edit', 'servidor-delete'])
                                <th class="text-center">Ações</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td style="width: 40%">{{ $employee->name }}</td>
                                <td style="width: 20%">{{ $employee->telephone }}</td>
                                <td style="width: 30%">{{ $employee->email }}</td>
                                <td style="width: 10%">
                                    <div class="btn-group float-right">
                                        <button type="button" class="btn btn-default">Ações</button>
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                            @can('servidor-edit')
                                                <form action="{{ url('employees/' . $employee->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- <input type="hidden" name="departament_id" value="{{ $employee->id }}"/> --}}
                                                    <button class="dropdown-item disable"
                                                        data-active="{{ $employee->active == 1 ? 'Desativar' : 'Reativar' }}"><i
                                                            class="fas fa-trash"></i>
                                                        {{ $employee->active == 1 ? 'Desativar' : 'Reativar' }}
                                                    </button>
                                                </form>
                                            @endcan
                                            @can('servidor-edit')
                                                <a class="dropdown-item" href="employees/{{ $employee->id }}/edit">
                                                    <i class="fas fa-edit"></i> Editar</a>
                                            @endcan
                                            @can('servidor-list')
                                                <a class="dropdown-item"
                                                    href="{{ route('employees.show', $employee->id) }}">
                                                    <i class="fas fa-info"></i> Informações</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $employees->links() }}
        </div>
    @else
        @if (session('active') == 1)
            <div class="alert alert-info">Não existem Servidores ativos ou cadastrados!</div>
        @else
            <div class="alert alert-info">Não existem Servidores desativados! <a href="{{ url('set_active') }}">Exibir
                    Ativos</a></div>
        @endif
    @endif
@stop

@section('js')
    <script>
        var a = document.querySelectorAll('.disable')
        a.forEach(element => {
            element.addEventListener('click', function disable(e) {
                let activeMsg = this.getAttribute('data-active')
                console.log(this.parentElement)
                e.preventDefault()

                Swal.fire({
                    title: 'Deseja ' + activeMsg + ' este Servidor?',
                    text: "Esta ação poderá ser revertida",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, ' + activeMsg + '!'
                }).then((result) => {
                    if (result.value) {
                        this.parentElement.submit()
                    } else {
                        return false
                    }
                })
            })
        });
    </script>
@endsection
