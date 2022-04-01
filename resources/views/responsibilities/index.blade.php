@extends('adminlte::page')

@section('title', 'Cargos')

@section('breadcrumb')
    {{ Breadcrumbs::render('positions.index') }}
@stop

@section('content_header')
<h1>Cargos</h1>
@stop

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismiss d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        <div class="ml-2">
            {{ session('success') }}
        </div>
    </div>
@endif
@if (session('danger'))
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" />
        </svg>
        <div class="ml-2">
            {{ session('danger') }}
        </div>
    </div>
@endif

@can('servidor-create')
    <div class="row">
        <div class="col">
            <div class="float-right mb-4">
                <a class="btn btn-secondary" href="{{ route('positions.create') }}">
                    <span class="fas fa-plus mr-1"></span>Novo
                </a>
            </div>
        </div>
    </div>
@endcan

@if (count($positions) > 0)
    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-sm table-striped table-hover table-valign-middle">
                <thead class="thead-dark ">
                    <tr>
                        <th>Cargos</th>
                        @can('servidor-edit')
                            <th class="text-center">Ações</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($positions as $position)
                        <tr>
                            <td style="width: 90%">{{ $position->name }}</td>
                            @can('servidor-edit')
                                <td>
                                    {{-- <form action="{{ url('positions/'. $position->id ) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-app float-right disable"><i class="fas fa-trash"></i> Excluir</button>
                                </form> --}}
                                    <a class="btn btn-app float-right" href="positions/{{ $position->id }}/edit">
                                        <i class="fas fa-edit"></i> Editar</a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $positions->links() }}
    </div>
@else
    <div class="alert alert-info d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
            <use xlink:href="#info-fill" />
        </svg>
        <div class="ml-2">
            Não existem cargos cadastrados!
        </div>
    </div>
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
                text: "Esta ação poderá ser revertida",
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
