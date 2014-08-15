<?php

namespace Tmo\Commander;

use Illuminate\Foundation\Application;

class DefaultCommandBus implements CommandBus
{

    private $app;
    protected $commandTranslator;

    /**
     * @param Application       $app
     * @param CommandTranslator $commandTranslator
     */
    function __construct(Application $app, CommandTranslator $commandTranslator)
    {
        $this->app = $app;
        $this->commandTranslator = $commandTranslator;
    }

    public function execute($command)
    {
        $handler = $this->commandTranslator->toCommandHandler($command);

        return $this->app->make($handler)->handle($command);
    }
} 