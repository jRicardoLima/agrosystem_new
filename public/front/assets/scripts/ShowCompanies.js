import {DataTable} from "./DataTable.js";

export class ShowCompanies{
    constructor(classe){
        $("."+classe).on('click',function(event){
           event.preventDefault();
           $.ajax({
               url: $(this).attr('href'),
               type: "GET",
               datatype: 'json',
               success: function (response) {

                   $('#loadModal').append(
                       `<div class="modal" id="modalCompanies" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Fornecedores</h4>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table id="modalTable" class="table table-bordered table-hover" style="background-color: darkgrey">
                                                    <thead>
                                                        <tr>
                                                            <th>Nome fantasia</th>
                                                            <th>Razão social</th>
                                                            <th>Contato</th>
                                                        </tr>
                                                    </thead>
                                                   <tbody id="dataCompanies">
                                                   
                                                   </tbody>
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
                    $.each(response.companiesProduct,function(key,companies){
                         $('#dataCompanies').append(
                            `<tr>
                                 <td><b><a href="../companies/${companies.id}/edit">${companies.fantasy_name}</a></b></td>
                                  <td><b>${companies.company_name}</b></td>
                                  <td><b>${companies.contact_one}</b></td>
                                </tr>`
                         )
                   });
                    $('.delete').click(function (event) {
                        event.preventDefault();
                        $.ajax({
                            url: $(this).attr('href'),
                            datatype: 'json',
                            success: function(response){
                                console.log(response);
                            }
                        });
                    });
                   $('#modalCompanies').modal('show');
                   new DataTable('#modalTable');
                   $('#exit').click(function () {
                       $('.modal').modal('hide');
                       $('.modal').remove();

                   });
               }
           });
        });
    }
}