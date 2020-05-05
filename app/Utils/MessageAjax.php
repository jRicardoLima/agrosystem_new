<?php


namespace App\Utils;


class MessageAjax
{
    private $message;
    private $type;

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function render()
    {
        return $this->html();
    }

    private function html()
    {
        return "<div class='alert alert-{$this->getType()}' role='alert'>{$this->getMessage()}</div>";
    }
}
