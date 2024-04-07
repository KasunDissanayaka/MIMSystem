<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepositoryCommand extends Command
{
    protected $signature = 'make:repository {name}';
    protected $description = 'Create repository and interface for a given name';

    public function handle()
    {
        $name = $this->argument('name');
        $interfaceName = $name . 'RepositoryInterface';
        $repositoryName = $name . 'Repository';

        $this->createInterface($interfaceName);
        $this->createRepository($repositoryName);
    }

    protected function createInterface($name)
    {
        $interfacePath = app_path('Interfaces/' . $name . '.php');
        if (!File::exists($interfacePath)) {
            File::put($interfacePath, "<?php\n\nnamespace App\Interfaces;\n\ninterface $name\n{\n    // Interface methods\n}\n");
            $this->info('Hi Kasun - Interface created successfully: ' . $interfacePath);
        } else {
            $this->error('Interface already exists: ' . $interfacePath);
        }
    }

    protected function createRepository($name)
    {
        $repositoryPath = app_path('Repositories/' . $name . '.php');
        if (!File::exists($repositoryPath)) {
            File::put($repositoryPath, "<?php\n\nnamespace App\Repositories;\n\nuse App\Interfaces\\" . $name . "Interface;\n\nclass $name implements {$name}Interface\n{\n    // Repository methods\n}\n");
            $this->info('Hi Kasun - Repository created successfully: ' . $repositoryPath);
        } else {
            $this->error('Repository already exists: ' . $repositoryPath);
        }
    }
    
}
