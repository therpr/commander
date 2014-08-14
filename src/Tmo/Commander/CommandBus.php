<?php
namespace Tmo\Commander;

interface CommandBus
{
    public function execute($command);
}