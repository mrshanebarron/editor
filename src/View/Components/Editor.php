<?php

namespace MrShaneBarron\Editor\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Editor extends Component
{
    public string $inputId;

    public function __construct(
        public string $name = 'content',
        public string $value = '',
        public ?string $placeholder = null,
        public bool $autofocus = false,
        public bool $disabled = false,
        public ?string $uploadEndpoint = null,
        ?string $id = null
    ) {
        $this->placeholder = $placeholder ?? config('sb-editor.placeholder', 'Write something...');
        $this->uploadEndpoint = $uploadEndpoint ?? config('sb-editor.upload_endpoint');
        $this->inputId = $id ?? 'editor-' . uniqid();
    }

    public function render(): View
    {
        return view('sb-editor::components.editor');
    }
}
