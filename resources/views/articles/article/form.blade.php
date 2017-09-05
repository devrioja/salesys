<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    {!! Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('nombre', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
    {!! Form::label('descripcion', 'Descripcion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
    {!! Form::label('category_id', 'Categoria', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('category_id',$categories,null, ['class' => 'form-control']) !!}
        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('brand_id') ? 'has-error' : ''}}">
    {!! Form::label('brand_id', 'Marcas', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('brand_id',$brands,null, ['class' => 'form-control']) !!}
        {!! $errors->first('brand_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('stockMin') ? 'has-error' : ''}}">
    {!! Form::label('stockMin', 'Stock Minimo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('stockMin', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('stockMin', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('stockMax') ? 'has-error' : ''}}">
    {!! Form::label('stockMax', 'Stock Maximo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('stockMax', null, ['class' => 'form-control']) !!}
        {!! $errors->first('stockMax', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('precio') ? 'has-error' : ''}}">
    {!! Form::label('precio', 'Precio', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('precio', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('precio', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
