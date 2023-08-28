<?php

namespace RSPR\LaravelStarter\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use RSPR\LaravelStarter\Services\FileMaker;

class MakeManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:rspr-manager {name : class manager name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new manager class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = FileMaker::specifyDataPathAndName($this->argument('name'));
        $name = $data['name'];
        $pathArray = $data['pathArray'];

        $classFolderPath = 'app/Managers/';
        $projectClassPathWithArgument = $classFolderPath;

        if (count($pathArray) > 0) {
            $projectClassPathWithArgument .= implode('/', $pathArray) . '/';
        }

        $folderPath  = base_path($projectClassPathWithArgument);
        $fileFullPath = $folderPath . "/{$name}.php";

        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }

        $classPath = explode('.php', $fileFullPath)[0];

        if (File::exists($fileFullPath)) {
            $this->error("Class {$classPath} already exists!");
            return;
        }

        $stub = $this->getStub($classFolderPath, $pathArray, $name);
        File::put($fileFullPath, $stub);

        $this->info("Class {$classPath} created successfully.");

        $parentClassPath = 'app/Managers/Manager.php';
        $parentClassFullPath = base_path($parentClassPath);

        if (!File::exists($parentClassFullPath)) {
            Artisan::call('vendor:publish', ['--tag' => 'rspr-manager-complete']);
            $this->info('Manager Assets published successfully!');
        }
    }

    protected function getStub($classFolderPath, $pathArray, $name)
    {
        $classFolderPathWithArgument = $classFolderPath . implode('/', $pathArray);
        $stubContent = <<<EOD
        <?php

        namespace {namespace};\n\r
        EOD;

        if (count($pathArray) > 0) {
            $stubContent .= <<<EOD
            use {classFolderPath}Manager;

            EOD;
            $stubContent = str_replace('{classFolderPath}', ucfirst(str_replace('/', '\\', $classFolderPath)), $stubContent);
        }

        $stubContent .= <<<EOD

        class {className} extends Manager
        {
            /**
             * @var [ModelName]Repository
             */
            // public [ModelName]Repository \$repository;

            public function __construct(/** [ModelName]Repository \$repository **/)
            {
                // \$this->repository = \$repository;
            }
        }\n
        EOD;
        $projectClassPathWithArgument = str_replace('/', '\\', $classFolderPathWithArgument);
        $stubContent = str_replace('{namespace}', $projectClassPathWithArgument, $stubContent);
        $rtn = str_replace('{className}', $name, $stubContent);

        return $rtn;
    }
}
