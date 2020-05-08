export class GeneralFunction{

    blockUnlockFields(id,target){
                $(function(){
                    let valueField = $('#number_of_children').val();
                    if(valueField){
                        $("#number_of_children").removeAttr('disabled');
                    }else{
                        $("#"+target).attr('disabled','disabled');
                    }
                    $("#"+id).change(function(){
                        let value = $(this).val();
                        console.log(value);

                        if(value == 1){
                            //console.log(valueField);
                            $("#"+target).removeAttr('disabled');
                        }else{

                            $("#"+target).attr('disabled','disabled');
                        }
                    })
                })
    }

    cpfCnpjField(id,cnpjId,cpfId){
        if(id){
            $("#"+cpfId).attr('disabled','disabled');
            $("#"+cnpjId).attr('disabled','disabled');
            $("#"+id).change(function(){
                let value = $(this).val();
                if(value == 0){
                    $("#"+cpfId).attr('disabled','disabled');
                    $("#"+cnpjId).removeAttr('disabled');
                } else if(value == 1){
                    $("#"+cnpjId).attr('disabled','disabled');
                    $("#"+cpfId).removeAttr('disabled');
                } else {
                    $("#"+cnpjId).attr('disabled','disabled');
                    $("#"+cpfId).attr('disabled','disabled');
                }
            });
        }
    }

    searchProductQuantityInformation(id,targets){
        if(id == "products_entry" && targets){
            $("#"+id).change(function(){
                let idProduct = $(this).val();

                $.ajax({
                    url: "product-moviment-quantity"+"/"+idProduct,
                    type:'GET',
                    dataType: 'json',
                    success: function (response) {
                        $("#minimum_quantity").val(response.product.minimum_quantity);
                        $("#minimum_quantity").attr('disabled','disabled');
                    }
                });
            })
        } else {
            $("#products_output").change(function(){
                let idProduct = $(this).val();

                $.ajax({
                    url: "product-moviment-quantity"+"/"+idProduct,
                    type:'GET',
                    dataType: 'json',
                    success: function (response) {
                        $("#minimum_quantity_output").val(response.product.minimum_quantity);
                        $("#minimum_quantity_output").attr('disabled','disabled');
                    }
                });
            })
        }
    }
}