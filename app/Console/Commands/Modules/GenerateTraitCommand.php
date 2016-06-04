<?php

namespace App\Console\Commands\Modules;

use Illuminate\Support\Str;
use Pingpong\Support\Stub;
use Pingpong\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Pingpong\Modules\Commands\GeneratorCommand;

class GenerateTraitCommand extends GeneratorCommand
{
    use ModuleCommandTrait;

    /**
     * The name of argument name.
     *
     * @var string
     */
    protected $argumentName = 'name';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make-trait';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new trait for the specified module.';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'The trait name.'),
            array('module', InputArgument::OPTIONAL, 'The name of module will be used.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('master', null, InputOption::VALUE_NONE, 'Indicates the master service provider', null),
        );
    }

    /**
     * @return mixed
     */
    protected function getTemplateContents()
    {
        $stub = 'trait';

        // 'name' => Str::studly($this->argument('name'),
        //'module' => $this->getModuleName()
        $module = $this->laravel['modules']->findOrFail($this->getModuleName());
        $name   = Str::studly($this->argument('name'));

        return (new Stub('/'.$stub.'.stub', [
            'NAMESPACE'         => $this->getClassNamespace($module),
            'CLASS'             => $this->getClass(),
            'LOWER_NAME'        => $module->getLowerName(),
            'MODULE'            => $this->getModuleName(),
            'NAME'              => $this->getFileName(),
            'STUDLY_NAME'       => $module->getStudlyName(),
            'MODULE_NAMESPACE'  => $this->laravel['modules']->config('namespace'),
        ]))->render();
    }

    /**
     * @return mixed
     */
    protected function getDestinationFilePath()
    {
        $path = $this->laravel['modules']->getModulePath($this->getModuleName());

        $generatorPath = $this->laravel['modules']->config('paths.generator.trait');

        return $path.$generatorPath.'/'.$this->getFileName().'.php';
    }

    /**
     * @return string
     */
    private function getFileName()
    {
        return Str::studly($this->argument('name')).'Trait';
    }

    /**
     * Get default namespace.
     *
     * @return string
     */
    public function getDefaultNamespace()
    {
        return 'Traits';
    }
}
