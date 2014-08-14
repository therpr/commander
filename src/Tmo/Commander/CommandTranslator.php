<?php
namespace Tmo\Commanding;

interface CommandTranslator
{
    public function toCommandHandler($command);

    public function toValidator($command);
}