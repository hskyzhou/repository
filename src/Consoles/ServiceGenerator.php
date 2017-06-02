<?php
namespace HskyZhou\Repository\Consoles;

/**
 * Class RepositoryEloquentGenerator
 * @package HskyZhou\Repository\Consoles
 */
class ServiceGenerator extends Generator
{

    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'service';

    /**
     * Get root namespace.
     *
     * @return string
     */
    public function getRootNamespace()
    {
        return parent::getRootNamespace() . parent::getConfigGeneratorClassPath($this->getPathConfigNode());
    }

    /**
     * Get generator path config node.
     *
     * @return string
     */
    public function getPathConfigNode()
    {
        return 'services';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . '/' . parent::getConfigGeneratorClassPath($this->getPathConfigNode(), true) . '/' . $this->getName() . 'Service.php';
    }

    /**
     * Get base path of destination file.
     *
     * @return string
     */
    public function getBasePath()
    {
        return config('repository.generator.basePath', app_path());
    }

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        $repository = parent::getRootNamespace() . parent::getConfigGeneratorClassPath('interfaces') . '\\' . $this->getName() . 'Repository;';
        
        $repository = str_replace(["\\",'/'], '\\', $repository);

        $repositoryClass = $this->getName() . 'Repository';

        return array_merge(parent::getReplacements(), [
            'repository'    => $repository,
            'repositoryClass' => $repositoryClass,
            'name' => lcfirst($this->getName()),
        ]);
    }
}
