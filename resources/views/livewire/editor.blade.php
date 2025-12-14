<div
    x-data="{
        init() {
            this.$refs.input.value = @js($value)
        }
    }"
    wire:ignore
    class="ld-editor"
>
    <input
        type="hidden"
        x-ref="input"
        id="{{ $inputId }}"
    >
    <trix-editor
        input="{{ $inputId }}"
        placeholder="{{ $placeholder }}"
        @if($autofocus) autofocus @endif
        @if($disabled) disabled @endif
        x-on:trix-change="$wire.set('value', $event.target.innerHTML)"
        class="prose prose-sm max-w-none focus:outline-none min-h-[200px] p-3 border border-gray-300 rounded-md"
    ></trix-editor>
</div>

@assets
    <link rel="stylesheet" href="{{ config('ld-editor.trix_css_url') }}">
    <style>
        trix-toolbar .trix-button-group { margin-bottom: 0; }
        trix-editor { min-height: 200px; }
        trix-editor:empty:not(:focus)::before {
            color: #9ca3af;
        }
    </style>
    <script src="{{ config('ld-editor.trix_js_url') }}"></script>
@endassets
