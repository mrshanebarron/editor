<?php

namespace MrShaneBarron\Editor;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\Editor\View\Components\Editor;
use Livewire\Livewire;

class EditorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/sb-editor.php', 'sb-editor');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'sb-editor');

        $this->publishes([
            __DIR__.'/../config/sb-editor.php' => config_path('sb-editor.php'),
        ], 'sb-editor-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/sb-editor'),
        ], 'sb-editor-views');

        // Register Blade component
        $this->loadViewComponentsAs('ld', [
            Editor::class,
        ]);

        // Register Livewire component if Livewire is installed
        if (class_exists(Livewire::class)) {
            Livewire::component('sb-editor', \MrShaneBarron\Editor\Livewire\Editor::class);
        }
    }
}
