export class SelectTwo{
    constructor(id,classe) {

        if(id != "" && id != null){
            $(function(){
                $(id).select2();
            });
        }

        if(classe != "" && classe != null) {
            $(function(){
                $(classe).select2();

            });
        }
    }
}
