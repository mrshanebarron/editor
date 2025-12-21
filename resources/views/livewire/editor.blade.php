<div
    x-data="{
        init() {
            this.$refs.input.value = @js($this->value)
        }
    }"
    wire:ignore
    style="position: relative;"
>
    <input
        type="hidden"
        x-ref="input"
        id="{{ $this->inputId }}"
    >
    <trix-editor
        input="{{ $this->inputId }}"
        placeholder="{{ $this->placeholder }}"
        @if($this->autofocus) autofocus @endif
        @if($this->disabled) disabled @endif
        x-on:trix-change="$wire.set('value', $event.target.innerHTML)"
        style="min-height: 200px; padding: 12px; border: 1px solid #d1d5db; border-radius: 6px; outline: none;"
    ></trix-editor>
</div>

@assets
    <link rel="stylesheet" href="{{ config('sb-editor.trix_css_url') }}">
    <style>
        trix-toolbar .trix-button-group { margin-bottom: 0; }
        trix-editor { min-height: 200px; }
        trix-editor:empty:not(:focus)::before {
            color: #9ca3af;
        }
    </style>
    <script src="{{ config('sb-editor.trix_js_url') }}"></script>
@endassets
