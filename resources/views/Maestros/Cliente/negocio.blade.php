<div class="box-body">
    <div class="col-md-8 col-md-offset-2">
        {!!Form::open(array('url'=>'negocio','method'=>'POST','autocompleted'=>'off'))!!}
        {{Form::token()}}
        <div class="row">
            <div class="form-group">
                <label for="idcli">Documento de cliente</label>
                <input type="text" readonly class="numeric form-control" value="{{ $clien->nrodoc }}" >
            </div>
            <div class="form-group">
                <label for="nomcli">Nombre de cliente</label>
                <input type="text" readonly class="form-control" value="{{ $clien->razons }}">
            </div>
        </div>
        <div class="form-group">
            <label for="idred">Seleccione la Red *</label>
            <select id="idred" name="idred" class="form-control">
                @foreach($redes as $item)
                    <option value="{{$item->id}}">{{$item->codred}}-{{$item->desred}}</option>
                @endforeach 
            </select>
        </div>
        <div class="form-group">
            <label for="idzon">Seleccione la Zona *</label>
            <select id="idzon" name="idzon" class="form-control">
                @foreach($zonas as $item)
                    <option value="{{$item->id}}">{{$item->codzon}}-{{$item->nomzon}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="idloc">Seleccione la Localidad *</label>
            <select id="idloc" name="idloc" class="form-control">
                @foreach($localidades as $item)
                    <option value="{{$item->id}}">{{$item->codloc}}-{{$item->nomloc}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nomneg">Nombre de negocio *</label>
            <input type="text" name="nomneg" class="text form-control" value="{{old('nomneg')}}">
        </div>
        <div class="form-group">
            <label for="direccion">Dirección *</label>
            <input type="text" name="direccion" class="text form-control" value="{{old('direccion')}}">
        </div>
        <div class="form-group">
            <label for="idciudad">Ciudad *</label>
            <select name="idciudad" id="idciudad" class="form-control">
                <option value="1">BOGOTA</option>
            </select>
        </div>
        <div class="form-group">
            <label for="telefono1">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="numeric form-control" value="{{old('telefono1')}}">
        </div>
        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" name="email" class="form-control" value="{{old('email')}}">
        </div>
        <div class="form-group">
            <label for="tipneg">Tipo de Negocio *</label>
            <select name="tipneg" id="tipneg" class="form-control">
                <option value="1">VENTAS VARIAS</option>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
        </div>
        {!!Form::close()!!}
    </div>
</div>