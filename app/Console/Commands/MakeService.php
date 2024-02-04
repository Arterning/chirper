<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new service class';

    public function handle()
    {
        $name = $this->argument('name');
        $className = Str::studly($name) . 'Service';
        $path = app_path('Services/' . $className . '.php');

        if (file_exists($path)) {
            $this->error('Service already exists!');
        } else {
            $filesystem = new Filesystem;
            $filesystem->put($path, $this->generateServiceTemplate($className));
            $this->info('[' . $path. ' ]created successfully');
        }
    }

    protected function generateServiceTemplate($className)
    {
        return '<?php' . PHP_EOL . PHP_EOL .
            'namespace App\Services;' . PHP_EOL . PHP_EOL .
            'class ' . $className . PHP_EOL .
            '{' . PHP_EOL .
            '    // Add your service logic here' . PHP_EOL .
            '}' . PHP_EOL;
    }
}