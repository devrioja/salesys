<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('apellido') ? 'has-error' : ''}}">
    {!! Form::label('apellido', 'Apellido', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('apellido', null, ['class' => 'form-control']) !!}
        {!! $errors->first('apellido', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('documento') ? 'has-error' : ''}}">
    {!! Form::label('documento', 'Documento', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('documento', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('documento', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('cuit') ? 'has-error' : ''}}">
    {!! Form::label('cuit', 'Cuit/Cuil', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('cuit', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('cuit', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('documento') ? 'has-error' : ''}}">
    {!! Form::label('razon_social', 'Razon Social', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('razon_social', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('razon_social', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
    {!! Form::label('telefono', 'Telefono', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('telefono', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('correo') ? 'has-error' : ''}}">
    {!! Form::label('correo', 'Correo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email('correo', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('correo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('direccion') ? 'has-error' : ''}}">
    {!! Form::label('direccion', 'Direccion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('direccion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('direccion', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
