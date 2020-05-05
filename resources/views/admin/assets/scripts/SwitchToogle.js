export class SwitchToogle{
    constructor(){

            $(function(){

                $("input[data-bootstrap-switch]").each(function () {
                  $(this).bootstrapSwitch('state',$(this).prop('checked'));
                });
            });

    }
}