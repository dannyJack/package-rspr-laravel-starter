<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use KgBot\LaravelLocalization\Classes\ExportLocalizations;

class UpdateLangResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-lang-resource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all localization messages to JavaScript file flat format, suitable for Lang.js';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $messages = (new ExportLocalizations())->export()->toFlat();
        $contents = json_encode($messages);
        Storage::disk('public')->put('lang/language-resource.json', $contents);
        $path = Storage::disk('public')->path('lang/language-resource.json');
        $this->info('Messages exported to JavaScript file, you can find them at ' . $path);
        return 0;
    }
}
