<?php

namespace Tmo\Commanding;

use Illuminate\Foundation\Application;

class ValidatorCommandBus implements CommandBus {

    private $app;
    protected $commandTranslator;
    /**
     * @var DefaultCommandBus
     */
    private $defaultCommandBus;

    /**
     * @param DefaultCommandBus $defaultCommandBus
     * @param Application       $app
     * @param CommandTranslator $commandTranslator
     */
    function __construct(DefaultCommandBus $defaultCommandBus, Application $app, CommandTranslator $commandTranslator)
    {
        $this->app = $app;
        $this->commandTranslator = $commandTranslator;
        $this->defaultCommandBus = $defaultCommandBus;
    }

    public function execute($command)
    {
        $validator = $this->commandTranslator->toValidator($command);

        if(class_exists($validator)) {
            $this->app->make($validator)->validate($command);
        }

        return $this->defaultCommandBus->execute($command);
    }
}