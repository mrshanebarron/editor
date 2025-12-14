<div
    x-data="{
        value: @js($value),
        init() {
            this.$refs.input.value = this.value
        },
        handleChange(event) {
            this.value = event.target.innerHTML
        }
    }"
    class="ld-editor"
>
    <input
        type="hidden"
        name="{{ $name }}"
        x-ref="input"
        :value="value"
        id="{{ $inputId }}"
    >
    <trix-editor
        input="{{ $inputId }}"
        placeholder="{{ $placeholder }}"
        @if($autofocus) autofocus @endif
        @if($disabled) disabled @endif
        x-on:trix-change="handleChange($event)"
        class="prose prose-sm max-w-none focus:outline-none min-h-[200px] p-3 border border-gray-300 rounded-md"
    ></trix-editor>
</div>

@once
    @push('styles')
        <link rel="stylesheet" href="{{ config('ld-editor.trix_css_url') }}">
        <style>
            trix-toolbar .trix-button-group { margin-bottom: 0; }
            trix-editor { min-height: 200px; }
            trix-editor:empty:not(:focus)::before {
                color: #9ca3af;
            }
        </style>
    @endpush
    @push('scripts')
        <script src="{{ config('ld-editor.trix_js_url') }}"></script>
    @endpush
@endonce
