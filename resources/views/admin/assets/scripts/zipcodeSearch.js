export class zipcodeSearch{
    constructor(identificador){
        this.id = identificador;
    }

    find(...targerFields){

            $("#"+this.id).blur(function(){
                let value = $("#"+this.id).val().replace('-','');
                if(value != "" || value != null){
                   const requisition =  $.ajax({
                        url: `http://viacep.com.br/ws/${value}/json`,
                        type:"GET",
                        datatype:"json",
                        success:function(response){

                            for(let fields of targerFields){

                                if(fields == "state"){
                                    $("#"+fields).val(response.uf);
                                }
                                if(fields == "city"){
                                    $("#"+fields).val(response.localidade);
                                }
                                if(fields == "street"){
                                    $("#"+fields).val(response.logradouro);
                                }
                                if(fields == "neighborhood"){
                                    $("#"+fields).val(response.bairro);
                                }

                            }
                        },
                    });
                }


            });
    }
}