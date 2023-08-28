<?php

namespace RSPR\LaravelStarter\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use RSPR\LaravelStarter\Services\FileMaker;

class MakeResponseCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:rspr-response-code {name : class response code name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new response code class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = FileMaker::specifyDataPathAndName($this->argument('name'));
        $name = $data['name'];
        $pathArray = $data['pathArray'];

        $classFolderPath = 'app/ResponseCodes';
        $projectClassPathWithArgument = $classFolderPath;

        if (count($pathArray) > 0) {
            $projectClassPathWithArgument .= '/' . implode('/', $pathArray);
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
            Artisan::call('vendor:publish', ['--tag' => 'rspr-response-code']);
            $this->info('Response Code Assets published successfully!');
        }
    }

    protected function getStub($classFolderPath, $pathArray, $name)
    {
        $classFolderPathWithArgument = $classFolderPath;

        if (count($pathArray) > 0) {
            $classFolderPathWithArgument .= '/' . implode('/', $pathArray);
        }

        $stubContent = <<<EOD
        <?php

        namespace {namespace};\n\r
        EOD;

        if (count($pathArray) > 0) {
            $stubContent .= <<<EOD
            use {classFolderPath}/ResponseCode;

            EOD;
            $stubContent = str_replace('{classFolderPath}', ucfirst(str_replace('/', '\\', $classFolderPath)), $stubContent);
        }

        $stubContent .= <<<EOD

        class {className} extends ResponseCode
        {
            // STORE
            // const STORE_SUCCESS_[DESCRIPTION] = 101;
            // const STORE_ERROR_[DESCRIPTION] = 201;

            // UPDATE
            // const UPDATE_SUCCESS_[DESCRIPTION] = 101;
            // const UPDATE_ERROR_[DESCRIPTION] = 201;

            // DESTROY
            // const DESTROY_SUCCESS_[DESCRIPTION] = 101;
            // const DESTROY_ERROR_[DESCRIPTION] = 201;
        }\n
        EOD;
        $projectClassPathWithArgument = ucfirst(str_replace('/', '\\', $classFolderPathWithArgument));
        $stubContent = str_replace('{namespace}', $projectClassPathWithArgument, $stubContent);
        $rtn = str_replace('{className}', $name, $stubContent);

        return $rtn;
    }
}
