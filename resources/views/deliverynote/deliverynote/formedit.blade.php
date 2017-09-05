<div class="form-group {{ $errors->has('fecha') ? 'has-error' : ''}}">
    {!! Form::label('fecha', 'Fecha', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('fecha', date('d-m-Y'), array('id' => 'datepicker','class' => 'form-control')) !!}
        {!! $errors->first('fecha', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : ''}}">
    {!! Form::label('supplier_id', 'Proveedor', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('supplier_id',$suppliers,$deliverynote->supplier_id, ['class' => 'form-control']) !!}
        {!! $errors->first('supplier_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('numero_remito') ? 'has-error' : ''}}">
    {!! Form::label('numero_remito', 'Numero de Remito', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('numero_remito', $deliverynote->numero_remito,['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('numero_remito', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
    {!! Form::label('descripcion', 'Descripcion', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('descripcion', $deliverynote->descripcion, ['class' => 'form-control']) !!}
        {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('deposit_id') ? 'has-error' : ''}}">
    {!! Form::label('deposit_id', 'Ingreso en Deposito', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('deposit_id',$deposits,$deliverynote->deposit_id, ['class' => 'form-control']) !!}
        {!! $errors->first('deposit_id', '<p class="help-block">:message</p>') !!}
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

    <?php
       // print_r(json_decode($deliverynote->articles));
        foreach ($deliverynote->articles  as $article){

            echo '<div class="alert alert-success" id="id'.$article->id.'">';
                echo $article->nombre." - ".$article->brand->nombre;
                echo '<input id="it'.$article->id.'" name="cantidad[]" class="form-control " required="required" placeholder="Ingrese Cantidad del Articulo" value="'.$article->pivot->cantidad_ingresada.'">';
                echo '<input name="articles[]" value="'.$article->id.'" type="hidden"><button type="button" onclick="deleteArticle(this.id);" class="btn btn-primary btn-xs" id="bt2">Delete</button>';
            echo '</div>';
        }
    ?>

</div>
<button type="button" class="btn btn-danger btn-xs" onclick="deleteArticles()" id="deleteArticles">Borrar Articulos</button>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
