<?php
namespace counter\V1\Rpc\Add;

class AddControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddController();
    }
}
