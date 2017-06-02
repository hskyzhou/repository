<?php
namespace HskyZhou\Repository\Consoles\Commands;

use Illuminate\Console\Command;

use HskyZhou\Repository\Consoles\PresenterGenerator;

class PresenterCommand extends Command
{

    /**
     * The name of command.
     *
     * @var string
     */
    protected $signature = 'make:presenter
        {name : The name of class being generated.}
        {--force : Force the creation if file already exists. }
    ';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new view presenter.';

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        $processGenerator = new PresenterGenerator([
            'name' => $this->argument('name'),
            'force' => $this->option('force'),
        ]);

        $processGenerator->run();
        $this->info("Presenter created successfully.");
    }
}
