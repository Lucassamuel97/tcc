<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="formAccomplish" id="formAccomplish" method="POST" action="{{url("$machine->id/maintenance/accomplish/")}}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title" id="accomplish_description"></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="price" class="control-label">Preço</label>
                                <input type="number" name="price" id="price" class="form-control"  placeholder="0.00">
                                <input type="hidden" name="id" id="accomplish_idmachine">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="obs" class="control-label">Observação</label>
                                <textarea class="form-control" name="obs" id="obs"></textarea>
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