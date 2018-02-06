<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$prov->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Se va a cambiar el estado del registro</h4>
            </div>      
            {{ Form::Open(['route' => ['proveedor.destroy', $prov->id], 'method' => 'DELETE']) }}
            {{ Form::token() }}    
            <div class="modal-body">
                    
                    <p>Desea continuar?</p>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    {{ Form::submit('Aceptar', array('class' => 'btn btn-primary')) }}
                </div>
            {{ Form::Close() }}
        </div>
    </div>
</div>