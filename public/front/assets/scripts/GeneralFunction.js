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

    hasValue(id){
        let value = document.getElementById(id).value;

        if(value){
            return true;
        }else{
            return false;
        }
    }
}