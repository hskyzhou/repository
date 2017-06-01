<?php
namespace HskyZhou\Repository\Consoles\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use HskyZhou\Repository\Consoles\FileAlreadyExistsException;
use HskyZhou\Repository\Consoles\MigrationGenerator;
use HskyZhou\Repository\Consoles\ModelGenerator;
use HskyZhou\Repository\Consoles\ProcessGenerator;
use HskyZhou\Repository\Consoles\RepositoryEloquentGenerator;
use HskyZhou\Repository\Consoles\RepositoryInterfaceGenerator;

class RepositoryCommand extends Command
{

    /**
     * The name of command.
     *
     * @var string
     */
    protected $signature = 'make:repository 
        {name : The name of class being generated. }
        {--fillable : The fillable attributes. }
        {--force : Force the creation if file already exists. }
    ';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new repository.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * @var Collection
     */
    protected $generators = null;


    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        $this->generators = new Collection();

        /* add migration*/
        $migrationModel = new MigrationGenerator([
            'name'   => 'create_' . snake_case(str_plural($this->argument('name'))) . '_table',
            'origin_name' => $this->argument('name'),
            'fields' => $this->option('fillable'),
            'force'  => $this->option('force'),
        ]);

        $this->generators->push($migrationModel);

        /* add model*/
        $modelGenerator = new ModelGenerator([
            'name'     => $this->argument('name'),
            'fillable' => $this->option('fillable'),
            'force'    => $this->option('force'),
        ]);

        $this->generators->push($modelGenerator);

        /* add repository*/
        $repositoryInterfaceGenerator = new RepositoryInterfaceGenerator([
            'name'  => $this->argument('name'),
            'force' => $this->option('force'),
        ]);
        $this->generators->push($repositoryInterfaceGenerator);

        /* execute generator*/
        foreach ($this->generators as $generator) {
            $generator->run();
        }

        $model = $modelGenerator->getRootNamespace() . '\\' . $modelGenerator->getName();
        $model = str_replace(["\\",'/'], '\\', $model);

        try {
            /* add repository*/
            $repositoryGenerator = new RepositoryEloquentGenerator([
                'name'      => $this->argument('name'),
                'force'     => $this->option('force'),
                'model'     => $model,
            ]);
            $repositoryGenerator->run();
            
            $this->info("Repository created successfully.");
        } catch (FileAlreadyExistsException $e) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        if($this->confirm("do you want to create process layer")){
            $repository = $repositoryGenerator->getRootNamespace() . '\\' . $repositoryGenerator->getName();
            $repository = str_replace(["\\",'/'], '\\', $repository);

            $processGenerator = new ProcessGenerator([
                'name' => $this->argument('name'),
                'force' => $this->option('force'),
                'repository' => $repository
            ]);

            $processGenerator->run();
        }
    }
}
