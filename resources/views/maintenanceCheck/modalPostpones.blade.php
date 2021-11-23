<div id="con-postpone-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="formpostpone" id="formpostpone" method="POST" action="{{url("$machine->id/maintenance/postpone/")}}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="postpone_description">Adiar manutenção</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="postpone_hodometro" class="control-label">Realizar manutenção a partir de tantas Horas:</label>
                                <input type="number" name="postpone_hodometro" id="postpone_hodometro" class="form-control" min="0" value="0" required>
                                <input type="hidden" name="id" id="postpone_maintenance_id">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="postpone_months" class="control-label">Realizar manutenção a partir de tantos Meses:</label>
                                <input type="number" name="postpone_months" id="postpone_months" class="form-control" min="0" value="0" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note" class="control-label">Observação</label>
                                <textarea class="form-control" name="note" id="note"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light" >Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>