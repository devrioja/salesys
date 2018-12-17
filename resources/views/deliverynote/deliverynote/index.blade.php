@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Listado de Remitos</div>
                    <div class="panel-body">
                        <a href="{{ url('deliverynote/create') }}" class="btn btn-success btn-sm" title="Agregar Remito">
                            <i class="fa fa-plus" aria-hidden="true"></i> Agregar Nuevo
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/deliverynote', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Fecha</th><th>Numero Remito</th><th>Proveedor</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($deliverynote as $item)
                                    <tr>
                                        <td>{{ $item->id_deliverynote }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->fecha)->format('d-m-Y') }}</td>
                                        <td>{{ $item->numero_remito }}</td>
                                        <td>{{ $item->nombre_s }}</td>
                                        <td>
                                            <a href="{{ url('/deliverynote/' . $item->id_deliverynote) }}" title="View DeliveryNote"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/deliverynote/' . $item->id_deliverynote . '/edit') }}" title="Edit DeliveryNote"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/deliverynote', $item->id_deliverynote],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete DeliveryNote',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
