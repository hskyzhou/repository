<?php
namespace HskyZhou\Repository\Consoles\Commands;

use Illuminate\Console\Command;

use HskyZhou\Repository\Consoles\ServiceGenerator;

class ServiceCommand extends Command
{

    /**
     * The name of command.
     *
     * @var string
     */
    protected $signature = 'make:service
        {name : The name of class being generated.}
        {--force : Force the creation if file already exists. }
    ';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new business service.';

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        $processGenerator = new ServiceGenerator([
            'name' => $this->argument('name'),
            'force' => $this->option('force'),
        ]);

        $processGenerator->run();
        $this->info("Service created successfully.");
    }
}
