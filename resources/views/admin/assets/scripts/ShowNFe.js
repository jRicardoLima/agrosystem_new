import {DataTable} from "./DataTable.js";

export class ShowNFe{
    constructor(classe){
        $('.'+classe).on('click',function(event){
            event.preventDefault();
            $.ajax({
                url: $(this).attr('href'),
                type:'GET',
                datatype:'json',
                success: function (response) {

                  $("#loadModalNFE").append(
                      `<div class="modal" id="modalNFe" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Notas fiscais</h4>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="modalTableNfe" class="table table-bordered table-hover" style="background-color: darkgrey">
                                                    <thead>
                                                        <tr>
                                                            <th>Nota fiscal</th>
                                                            <th>Chave de acesso</th>
                                                            <th>Data de entrada</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="dataNfe"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" id="exit" class="btn btn-secondary btn-success">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>`
                  );

                  $.each(response.invoice,function(key,nfe){
                        $('#dataNfe').append(
                            `<tr>
                                <td><a class="btn btn-block bg-gradient-info btn-sm" href="../invoices/download/${nfe.product_id}/${nfe.access_key}">Download</a></td>
                                <td><b>${nfe.access_key}</b></td>
                                <td><b>${nfe.created_at}</b></td>
                            </tr>`
                        );
                  });
                  $('#modalNFe').modal('show');
                  new DataTable('#modalTableNfe');
                  $('#exit').click(function(){
                      $('.modal').modal('hide');
                      $('.modal').remove();
                  });
                }
            });
        });
    }
}