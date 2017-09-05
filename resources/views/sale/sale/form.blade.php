<div class="form-group {{ $errors->has('fecha') ? 'has-error' : ''}}">
    {!! Form::label('fecha', 'Fecha', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-xs-5">
        {!! Form::text('fecha', date('d-m-Y'), array('id' => 'datepicker','class' => 'form-control')) !!}
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('numero_factura') ? 'has-error' : ''}}">
    {!! Form::label('numero_factura', 'Numero de Factura    ', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('numero_factura', null,['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('numero_factura', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    {!! Form::label('customer_id', 'Clientes', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-xs-3">
        {!! Form::select('customer_id',$customers,null, ['class' => 'form-control'])!!}
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
    {!! Form::label('descripcion', 'Descripcion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    {!! Form::label('articles', 'Buscar Articulos', ['class' => 'col-md-4 control-label', 'placeholder' => 'Buscar por Nombre']) !!}
    <div class="input-group input-group-sm">
        {!! Form::text('articleName','',['class' => 'form-control col-xs-2', 'placeholder' => 'Buscar por Nombre','id' => 'articleName']) !!}
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
        <div class="input-group-btn">
            <button class="btn btn-default " type="button" id="btnSearch" onclick="getArticle()">
                <i class="glyphicon glyphicon-search"></i>
            </button>
        </div>
    </div>
</div>
<div class="panel-heading">
    <strong>LISTADO DE ARTICULOS</strong>
</div>
<div id="listaArticulos" class="panel panel-default">

</div>
<button type="button" class="btn btn-danger btn-xs" onclick="deleteArticles()" id="deleteArticles">Borrar Articulos</button>
<div class="form-group {{ $errors->has('costoTotal') ? 'has-error' : ''}}">
    {!! Form::label('costoTotal', 'Costototal', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('costoTotal', 'Total', ['class' => 'form-control']) !!}
        {!! $errors->first('costoTotal', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
        {!! Form::reset('Limpiar',['class' => 'btn btn-primary']) !!}
    </div>
</div>
