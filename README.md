# Laravel Design Editor

Trix-based rich text editor component for Laravel. Supports Livewire, Blade, and Vue 3.

## Installation

```bash
composer require mrshanebarron/editor
```

For Vue components:
```bash
npm install @laraveldesign/editor
```

Include Trix CSS and JS in your layout:

```html
<link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
```

## Usage

### Livewire Component

```blade
<livewire:ld-editor wire:model="content" />

{{-- With options --}}
<livewire:ld-editor
    wire:model="content"
    placeholder="Write your post content..."
    :autofocus="true"
/>

{{-- With file uploads --}}
<livewire:ld-editor
    wire:model="content"
    upload-endpoint="/api/uploads"
/>
```

### Blade Component

```blade
<x-ld-editor name="content" />

{{-- With initial value --}}
<x-ld-editor name="body" :value="$post->body" />

{{-- With placeholder --}}
<x-ld-editor
    name="description"
    placeholder="Describe your product..."
/>

{{-- Disabled --}}
<x-ld-editor name="readonly" :value="$content" :disabled="true" />
```

### Vue 3 Component

```vue
<script setup>
import { ref } from 'vue'
import { LdEditor } from '@laraveldesign/editor'

const content = ref('')
</script>

<template>
  <LdEditor
    v-model="content"
    placeholder="Start writing..."
    @change="handleChange"
  />
</template>
```

## Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `value` | string | `''` | Editor content (HTML) |
| `placeholder` | string | `'Write something...'` | Placeholder text |
| `autofocus` | boolean | `false` | Focus editor on mount |
| `disabled` | boolean | `false` | Disable editing |
| `uploadEndpoint` | string | `null` | URL for file uploads |
| `inputId` | string | auto | Custom input ID |

## Events

### Livewire Events

```javascript
Livewire.on('editor-updated', ({ value }) => {
    console.log('Editor content:', value);
});
```

### Vue Events

```vue
<LdEditor
  v-model="content"
  @change="handleChange"
  @focus="handleFocus"
  @blur="handleBlur"
/>
```

## File Uploads

Configure an upload endpoint to handle file attachments:

```php
// routes/web.php
Route::post('/api/uploads', function (Request $request) {
    $path = $request->file('file')->store('uploads', 'public');

    return response()->json([
        'url' => Storage::url($path)
    ]);
})->middleware('auth');
```

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=ld-editor-config
```

### Configuration Options

```php
// config/ld-editor.php
return [
    'placeholder' => 'Write something...',
    'upload_endpoint' => null,
    'toolbar' => [
        'bold', 'italic', 'strike',
        'heading1',
        'quote', 'code',
        'bullet', 'number',
        'decreaseNesting', 'increaseNesting',
        'attachFiles',
        'undo', 'redo',
    ],
];
```

## Customization

### Publishing Views

```bash
php artisan vendor:publish --tag=ld-editor-views
```

### Trix Styling

Customize the Trix editor appearance by overriding CSS variables:

```css
trix-editor {
    --trix-button-color: #333;
    --trix-button-active-background-color: #e5e5e5;
}
```

## Security

The editor outputs HTML. Always sanitize user-generated content before displaying:

```php
use Illuminate\Support\Str;

// In your model or controller
$cleanHtml = Str::of($content)->sanitizeHtml();

// Or use a package like HTMLPurifier
$cleanHtml = clean($content);
```

## License

MIT
