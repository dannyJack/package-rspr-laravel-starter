<?php

namespace RSPR\LaravelStarter\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use RSPR\LaravelStarter\Services\FileMaker;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:rspr-repository {name : class repository name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = FileMaker::specifyDataPathAndName($this->argument('name'));
        $name = $data['name'];
        $pathArray = $data['pathArray'];

        $classFolderPath = 'app/Repositories/';
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

        $parentClassPath = 'app/Repositories/Repository.php';
        $parentClassFullPath = base_path($parentClassPath);

        if (!File::exists($parentClassFullPath)) {
            Artisan::call('vendor:publish', ['--tag' => 'rspr-repository-complete']);
            $this->info('Repository Assets published successfully!');
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
            use {classFolderPath}Repository;

            EOD;
            $stubContent = str_replace('{classFolderPath}', ucfirst(str_replace('/', '\\', $classFolderPath)), $stubContent);
        }

        $stubContent .= <<<EOD

        class {className} extends Repository
        {
            // public \$model = [Mode]::class;
        }\n
        EOD;
        $projectClassPathWithArgument = str_replace('/', '\\', $classFolderPathWithArgument);
        $stubContent = str_replace('{namespace}', $projectClassPathWithArgument, $stubContent);
        $rtn = str_replace('{className}', $name, $stubContent);

        return $rtn;
    }
}
