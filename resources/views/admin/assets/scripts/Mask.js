export class Mask{
    constructor(id,classe,mask,reverse) {

            if(id != "" && id != null){
                if(reverse){
                    $(function(){
                        $(id).mask(mask,{reverse:true});
                    });
                }else {
                    $(function(){
                        $(id).mask(mask);
                    });
                }
            }

            if(classe != "" && classe != null){
                if(reverse){
                    $(function(){
                        $(classe).mask(mask,{reverse:true});
                    });
                }else {
                    $(function(){
                        $(classe).mask(mask);
                    });
                }

            }
    }
}
