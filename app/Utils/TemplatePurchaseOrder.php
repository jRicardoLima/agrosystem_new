<?php


namespace App\Utils;


use Illuminate\Support\Facades\Auth;

class TemplatePurchaseOrder
{
    private $text;
    private $number;
    private $date;
    public function __construct(string $text,int $number)
    {
        $this->text = $text;
        $this->number = $number;
        $d = new \DateTime();
        $this->date = $d->format('d/m/Y');
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
                    <p><b>teste
                    </b></p>
                </div>
                <div>
                    <p>Solicitado Por:___________________________________________</p>
                    <p>Autorizado Por:___________________________________________</p>
                    
                </div>
            </div>
        </main>
HEREDOC;
    return $html;
    }

    public function render()
    {
        return $this->header().$this->main();
    }
}