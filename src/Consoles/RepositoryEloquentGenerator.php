<?php
namespace HskyZhou\Repository\Consoles;

use HskyZhou\Repository\Consoles\Migrations\SchemaParser;

/**
 * Class RepositoryEloquentGenerator
 * @package HskyZhou\Repository\Consoles
 */
class RepositoryEloquentGenerator extends Generator
{

    /**
     * Get stub name.
     *
     * @var string
     */
    protected $stub = 'repository/eloquent';

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
        return 'repositories';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . '/' . parent::getConfigGeneratorClassPath($this->getPathConfigNode(), true) . '/' . $this->getName() . 'RepositoryEloquent.php';
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
        
        $repository = str_replace([
            "\\",
            '/'
        ], '\\', $repository);

        return array_merge(parent::getReplacements(), [
            'fillable'      => $this->getFillable(),
            'repository'    => $repository,
            'model'         => isset($this->options['model']) ? $this->options['model'] : ''
        ]);
    }

    /**
     * Get the fillable attributes.
     *
     * @return string
     */
    public function getFillable()
    {
        if (!$this->fillable) {
            return '[]';
        }
        $results = '[' . PHP_EOL;

        foreach ($this->getSchemaParser()->toArray() as $column => $value) {
            $results .= "\t\t'{$column}'," . PHP_EOL;
        }

        return $results . "\t" . ']';
    }

    /**
     * Get schema parser.
     *
     * @return SchemaParser
     */
    public function getSchemaParser()
    {
        return new SchemaParser($this->fillable);
    }
}