<?php


namespace App\Utils;


class NetworkManager
{
    private $ip;

    public function __construct(string $ip)
    {
        $this->ip = $ip;
    }

    public function saveIpDatabase(object $object,$id)
    {
        $model = $object->where('id','=',$id)->first();

        $model->ip = $this->ip;

        $model->save();

        return $this;
    }
}
