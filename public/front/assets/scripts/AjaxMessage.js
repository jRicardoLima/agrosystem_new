export class AjaxMessage{
    loadMessage(id,message,isVisible){
        $(function(){
            $(id).append(
                message
            );
           if(isVisible == true){
               $(id).show();
           }
        });
    }
}
