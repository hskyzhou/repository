<?php
namespace HskyZhou\Repository\Consoles\Commands;

use Illuminate\Console\Command;

class EntityCommand extends Command
{

    /**
     * The name of command.
     *
     * @var string
     */
    protected $signature = 'make:entity
        {name : The name of class being generated.}
        {--fillable : The fillable attributes. }
        {--force : Force the creation if file already exists. }
    ';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new entity.';

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        $this->call('make:repository', [
            'name'        => $this->argument('name'),
            '--fillable'  => $this->option('fillable'),
            '--force'     => $this->option('force'),
        ]);

        $this->call('make:bindings', [
            'name'    => $this->argument('name'),
            '--force' => $this->option('force')
        ]);
    }
}
