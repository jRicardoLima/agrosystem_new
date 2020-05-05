export class DataTable{
    constructor(id) {

        if(id != "" && id != null){
            $(function(){
                $(id).DataTable({
                    "responsive":true,
                    "autoWidth":false

                });
            });
        }
    }
}
