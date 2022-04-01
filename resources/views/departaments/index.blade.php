@extends('adminlte::page')

@section('title', 'Departamentos')

@section('content_header')
    <h1>Departamentos</h1>
@stop
@section('breadcrumb')
    {{ Breadcrumbs::render('departaments.index') }}
@stop
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismiss">
            {{ session('success') }}
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif

    @can('servidor-create')
        <div class="row">
            <div class="col">
                <a class="btn btn-secondary mb-4 float-right" href="{{ route('departaments.create') }}">
                    <span class="fas fa-plus mr-1"></span>Novo
                </a>

                @if (session('departaments_inactives') == 1)
                    <a class="btn btn-warning mb-4 float-left" href="{{ route('departaments.index', ['status' => null]) }}">
                        <span class="fas fa-eye mr-1"></span>Mostrar Somente Ativos
                    </a>
                @else
                    <a class="btn btn-secondary mb-4 float-left" href="{{ route('departaments.index', ['status' => 1]) }}">
                        <span class="fas fa-eye mr-1"></span>Mostrar Inativos
                    </a>
                @endcan
        </div>
    </div>
@endcan
@if (count($departaments) > 0)
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-sm table-striped table-hover table-valign-middle">
                <thead class="thead-dark ">
                    <tr>
                        <th>Departamentos</th>
                        @can(['servidor-edit', 'servidor-delete'])
                            <th class="text-center">Ações</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departaments as $departament)
                        <tr class="{{ $departament->status==0?'table-danger':''}}">
                            <td style="width: 78%">{{ $departament->name }}</td>
                            @can(['servidor-edit', 'servidor-delete'])

                                <td>
                                    <div class="btn-group float-right">
                                        <button type="button" class="btn btn-default">Ações</button>
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu" style="">
                                            @can('servidor-edit')
                                                <form action="{{ url('departaments/' . $departament->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    {{-- <input type="hidden" name="departament_id" value="{{ $departament->id }}"/> --}}
                                                    <button class="dropdown-item disable"
                                                        data-active="{{ $departament->status == 1 ? 'Desativar' : 'Reativar' }}"><i
                                                            class="fas fa-trash"></i>
                                                        {{ $departament->status == 1 ? 'Desativar' : 'Reativar' }}
                                                    </button>
                                                </form>
                                            @endcan
                                            @can('servidor-edit')
                                                <a class="dropdown-item" href="departaments/{{ $departament->id }}/edit">
                                                    <i class="fas fa-edit"></i> Editar</a>
                                            @endcan
                                            @can('servidor-list')
                                                <a class="dropdown-item"
                                                    href="{{ route('departaments.show', $departament->id) }}">
                                                    <i class="fas fa-info"></i> Informações</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $departaments->links() }}
    </div>
@else
    <div class="alert alert-info">Não existem departamentos cadastrados</div>
@endif
@stop

@section('js')
<script>
    var a = document.querySelectorAll('.disable')
    a.forEach(element => {
        element.addEventListener('click', function disable(e) {
            console.log(this.parentElement)
            e.preventDefault()

            Swal.fire({
                title: 'Confirma?',
                text: "Está ação poderá ser revertida",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, desativar!'
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
@stop
