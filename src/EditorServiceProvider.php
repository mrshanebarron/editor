<?php

namespace MrShaneBarron\Editor;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\Editor\View\Components\Editor;
use Livewire\Livewire;

class EditorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ld-editor.php', 'ld-editor');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ld-editor');

        $this->publishes([
            __DIR__.'/../config/ld-editor.php' => config_path('ld-editor.php'),
        ], 'ld-editor-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/ld-editor'),
        ], 'ld-editor-views');

        // Register Blade component
        $this->loadViewComponentsAs('ld', [
            Editor::class,
        ]);

        // Register Livewire component if Livewire is installed
        if (class_exists(Livewire::class)) {
            Livewire::component('ld-editor', \MrShaneBarron\Editor\Livewire\Editor::class);
        }
    }
}
