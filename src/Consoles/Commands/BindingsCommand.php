<?php
namespace HskyZhou\Repository\Consoles\Commands;

use File;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use HskyZhou\Repository\Consoles\BindingsGenerator;
use HskyZhou\Repository\Consoles\FileAlreadyExistsException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class BindingsCommand extends Command
{

    /**
     * The name of command.
     *
     * @var string
     */
    protected $signature = 'make:bindings
        {name : The name of model for which the controller is being generated.}
        {--force : Force the creation if file already exists. }
    ';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Add repository bindings to service provider.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Bindings';


    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        try {
            $bindingGenerator = new BindingsGenerator([
                'name' => $this->argument('name'),
                'force' => $this->option('force'),
            ]);
            // generate repository service provider
            if (!file_exists($bindingGenerator->getPath())) {
                $this->call('make:provider', [
                    'name' => $bindingGenerator->getConfigGeneratorClassPath($bindingGenerator->getPathConfigNode()),
                ]);
                // placeholder to mark the place in file where to prepend repository bindings
                $provider = File::get($bindingGenerator->getPath());
                File::put($bindingGenerator->getPath(), vsprintf(str_replace('//', '%s', $provider), [
                    '//',
                    $bindingGenerator->bindPlaceholder
                ]));
            }
            $bindingGenerator->run();
            $this->info($this->type . ' created successfully.');
        } catch (FileAlreadyExistsException $e) {
            $this->error($this->type . ' already exists!');

            return false;
        }
    }
}
