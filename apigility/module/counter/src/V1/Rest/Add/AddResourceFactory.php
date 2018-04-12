<?php
namespace counter\V1\Rest\Add;

class AddResourceFactory
{
    public function __invoke($services)
    {
        return new AddResource();
    }
}
