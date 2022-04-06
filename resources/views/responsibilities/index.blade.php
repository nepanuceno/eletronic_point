@extends('adminlte::page')

@section('title', __('responsibility.label_responsibility'))

@section('plugins.Sweetalert2', true)

@section('breadcrumb')
    {{ Breadcrumbs::render('responsibilities.index') }}
@stop

@section('content_header')
    <h1>{{ __('responsibility.label_responsibility') }}</h1>
@stop

@section('content')
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
                    <a class="btn btn-secondary" href="{{ route('responsibilities.create') }}">
                        <span class="fas fa-plus mr-1"></span>{{ __('app.btn-new') }}
                    </a>
                </div>
            </div>
        </div>
    @endcan

    @if (count($responsibilities) > 0)
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-sm table-striped table-hover table-valign-middle">
                    <thead class="thead-dark ">
                        <tr>
                            <th>{{ __('responsibility.label_responsibility') }}</th>
                            @can('servidor-edit')
                                <th class="text-center">{{ __('app.label-actions') }}</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($responsibilities as $position)
                            <tr>
                                <td style="width: 90%">{{ $position->name }}</td>
                                @can('servidor-edit')
                                    <td>
                                        {{-- <form action="{{ url('responsibilities/'. $position->id ) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-app float-right disable"><i class="fas fa-trash"></i> Excluir</button>
                                    </form> --}}
                                        <a class="btn btn-app float-right" href="responsibilities/{{ $position->id }}/edit">
                                            <i class="fas fa-edit"></i> {{ __('app.btn-edit') }}</a>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $responsibilities->links() }}
        </div>
    @else
        <div class="alert alert-info d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                <use xlink:href="#info-fill" />
            </svg>
            <div class="ml-2">
                {{ __('responsibility.no-positions-registered') }}
            </div>
        </div>
    @endif

@stop

@section('js')
    @if ($message = Session::get('success'))
        @alertSuccess({{ $message }});
    @endif
@endsection
