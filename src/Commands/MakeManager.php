<?php

namespace RSPR\LaravelStarter\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

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
        $data = $this->checkArgument();
        $name = $data['name'];
        $pathArray = $data['pathArray'];

        $classFolderPath = 'app/Managers/';
        $projectManagersPathWithArgument = $classFolderPath . implode('/', $pathArray);
        $folderPath  = base_path($projectManagersPathWithArgument);
        $fileFullPath = $folderPath . "/{$name}.php";

        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }

        if (File::exists($fileFullPath)) {
            $errorClass = explode('.php', $fileFullPath)[0];
            $this->error("Class {$errorClass} already exists!");
            return;
        }

        $stub = $this->getStub($classFolderPath, $pathArray, $name);
        File::put($fileFullPath, $stub);

        $this->info("Class {$name} created successfully.");

        $managerClassPath = 'app/Managers/Manager.php';
        $managerFullPath = base_path($managerClassPath);

        if (!File::exists($managerFullPath)) {
            Artisan::call('vendor:publish', ['--tag' => 'rspr-manager']);
            $this->info('Assets published successfully!');
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
            $stubContent = str_replace('{classFolderPath}', str_replace('/', '\\', $classFolderPath), $stubContent);
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
        $projectManagersPathWithArgument = str_replace('/', '\\', $classFolderPathWithArgument);
        $stubContent = str_replace('{namespace}', $projectManagersPathWithArgument, $stubContent);
        $rtn = str_replace('{className}', $name, $stubContent);

        return $rtn;
    }

    protected function checkArgument()
    {
        $rtn = [
            'name' => '',
            'pathArray' => []
        ];

        $path = $this->argument('name');
        $pathList1st = explode('/', $path);
        $pathList2nd = [];

        foreach ($pathList1st as $ind => $path) {
            $path = explode('\\', $path);
            $pathList2nd = array_merge($pathList2nd, $path);
        }

        $path = implode('/', $pathList2nd);

        if ($path[0] === '/' || $path[0] === '\\') {
            $path = substr($path, 1);
        }

        if ($path[strlen($path) - 1] === '/' || $path[strlen($path) - 1] === '\\') {
            $path = substr($path, 0, strlen($path) - 1);
        }

        $pathList1st = explode('/', $path);
        $rtn['name'] = array_pop($pathList1st);
        $rtn['pathArray'] = $pathList1st;

        return $rtn;
    }
}
