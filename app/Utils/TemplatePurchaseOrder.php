<?php


namespace App\Utils;


use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;

class TemplatePurchaseOrder
{
    private $text;
    private $number;
    private $date;
    private $mpdf;
    private $requestingUser;
    private $authorizedBy;
    public function __construct(string $text,int $number,$requestingUser,$authorizedBy,Mpdf $mpdf)
    {
        $this->text = $text;
        $this->number = $number;
        $d = new \DateTime();
        $this->date = $d->format('d/m/Y');
        $this->requestingUser = $requestingUser;
        $this->authorizedBy = $authorizedBy;
        $this->mpdf = $mpdf;
    }

    private function header()
    {
        $html = <<<HEREDOC
        <div class="container">
        <header>
            <div class="row">
            <div class="col-md-6">
                <h2 style="text-align: center">Requsição de material</h2>
            </div>
            
            <div class="col-md-3">
                <p style="text-align: right">
                  Numero: <b><i>$this->number</i></b>
                  Data: <b><i>$this->date</i></b>
                </p>
            </div>
         </div> 
        </header>
      </div>
HEREDOC;
        return $html;
    }

    private function main()
    {
        $user = Auth::user()->name;
        $html = <<<HEREDOC
        <main>
            <div class="row">
                <div class="col-md-12">
                    $this->text
                </div>
                <div>
                    <p><b>Solicitado por: $this->requestingUser </b></p>
                    <p>Assinatura do solicitante:___________________________________________</p>
                    <p><b>Autorizado Por: $this->authorizedBy</b></p>
                    <p>Assinatura do autorizador:___________________________________________</p>
                    
                </div>
            </div>
        </main>
        <footer>
            <small>Requsição gerada por: $user</small>
        </footer>
HEREDOC;
    return $html;
    }

    public function render()
    {
        $this->mpdf->WriteHTML($this->header().$this->main());
        $this->mpdf->Output();
    }
}