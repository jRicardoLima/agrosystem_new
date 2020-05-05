import {AjaxMessage} from './AjaxMessage.js';
export class Login {

    logar(){
        $(function (){
           $.ajaxSetup({
               headers:{
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });

           $('#formLogin').submit(function(e) {
               e.preventDefault();

               $.ajax({
                   url: $(this).attr('action'),
                   type:'POST',
                   data: $(this).serialize(),
                   datatype:'json',
                   success:function(response){
                        $('#messageAlert').hide();

                       if(response.message){
                           const messageAjax = new AjaxMessage();
                           messageAjax.loadMessage('#messageAlert',response.message,true);
                       }

                       if(response.redirect){
                           window.location.href = response.redirect
                       }
                   }
               });
           });
        });
    }

    logoff(){
        console.log('funcionou logoff');
    }
}

