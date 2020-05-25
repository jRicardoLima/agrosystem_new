import {Mask} from "./Mask.js";
export class AddInstallments {
    constructor(idNumberInstallments,idButton){
        $("#"+idButton).click(function(){
            let numberInstallments = $('#'+idNumberInstallments).val();

            if(numberInstallments == "" || numberInstallments <= 0){
                alert('Atenção o numero de parcelas deve ser um numero valido');
            } else {
                for(let i = 0; i < numberInstallments; i++){
                    $('#generate_rows').append(
                        `<div class="row">
                            <div class="col-md-4">
                                <label for="value_${i+1}">Valor</label>
                                <input type="text" name="data[]" id="value_${i+1}" class="form-control input-sm installment_value">
                            </div>
                            <div class="col-md-4">
                                <label>Data de vencimento</label>
                                <input type="text" name="data[]" id="due_date_${i+1}" class="form-control input-sm installment_due_date">
                            </div>
                            <div class="col-md-4">
                                <label>Status</label>
                                <select name="data[]" id="status_${i+1}" class="form-control">
                                    <option value="0" selected>A pagar</option>
                                    <option value="1">Pago</option>
                                </select>
                            </div>
                        </div>`
                    );

                    new Mask(null,'.installment_due_date','00/00/0000');
                    new Mask(null,'.installment_value','##.##0,00',true);
                }
            }
        });
    }
}