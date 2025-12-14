<?php

namespace MrShaneBarron\Editor\Livewire;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class Editor extends Component
{
    #[Modelable]
    public string $value = '';

    public string $placeholder = '';
    public bool $autofocus = false;
    public bool $disabled = false;
    public ?string $uploadEndpoint = null;
    public string $inputId = '';

    public function mount(
        string $value = '',
        ?string $placeholder = null,
        bool $autofocus = false,
        bool $disabled = false,
        ?string $uploadEndpoint = null,
        ?string $inputId = null
    ): void {
        $this->value = $value;
        $this->placeholder = $placeholder ?? config('ld-editor.placeholder', 'Write something...');
        $this->autofocus = $autofocus;
        $this->disabled = $disabled;
        $this->uploadEndpoint = $uploadEndpoint ?? config('ld-editor.upload_endpoint');
        $this->inputId = $inputId ?? 'editor-' . uniqid();
    }

    public function updatedValue(): void
    {
        $this->dispatch('editor-updated', value: $this->value);
    }

    public function render()
    {
        return view('ld-editor::livewire.editor');
    }
}
