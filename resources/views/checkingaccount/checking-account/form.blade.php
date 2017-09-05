<div class="form-group {{ $errors->has('fecha_alta') ? 'has-error' : ''}}">
    {!! Form::label('fecha_alta', 'Fecha Alta', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('fecha_alta', date('d-m-Y'), array('id' => 'datepicker','class' => 'form-control')) !!}
        {!! $errors->first('fecha_alta', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('fecha_vencimiento') ? 'has-error' : ''}}">
    {!! Form::label('fecha_vencimiento', 'Fecha Vencimiento', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('fecha_vencimiento', date('d-m-Y'), array('id' => 'datepicker2','class' => 'form-control')) !!}
        {!! $errors->first('fecha_vencimiento', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
    {!! Form::label('customer_id', 'Clientes', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-xs-3">
        {!! Form::select('customer_id',$customers,null, ['class' => 'form-control'])!!}
        {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('balance') ? 'has-error' : ''}}">
    {!! Form::label('balance', 'Balance', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('balance', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('balance', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
    {!! Form::label('descripcion', 'Descripcion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('descripcion', null, ['class' => 'form-control']) !!}
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
