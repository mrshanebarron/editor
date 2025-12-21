# Editor

A rich text editor component for Laravel applications. WYSIWYG editing with toolbar for formatting. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/editor
```

## Livewire Usage

### Basic Usage

```blade
<livewire:sb-editor wire:model="content" />
```

### With Placeholder

```blade
<livewire:sb-editor
    wire:model="article"
    placeholder="Write your article..."
/>
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `wire:model` | string | - | HTML content |
| `placeholder` | string | `'Write something...'` | Placeholder text |
| `editor-class` | string | `''` | Additional CSS classes |

## Vue 3 Usage

### Setup

```javascript
import { SbEditor } from './vendor/sb-editor';
app.component('SbEditor', SbEditor);
```

### Basic Usage

```vue
<template>
  <SbEditor v-model="content" />
</template>

<script setup>
import { ref } from 'vue';
const content = ref('');
</script>
```

### With Options

```vue
<template>
  <SbEditor
    v-model="content"
    placeholder="Start writing your blog post..."
    editor-class="min-h-[400px]"
  />
</template>
```

### Form Example

```vue
<template>
  <form @submit.prevent="save" class="space-y-4">
    <div>
      <label class="block text-sm font-medium mb-2">Title</label>
      <input v-model="form.title" class="w-full px-3 py-2 border rounded-lg" />
    </div>

    <div>
      <label class="block text-sm font-medium mb-2">Content</label>
      <SbEditor v-model="form.content" />
    </div>

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
      Publish
    </button>
  </form>
</template>

<script setup>
import { reactive } from 'vue';

const form = reactive({
  title: '',
  content: ''
});

const save = () => {
  console.log('Saving:', form);
};
</script>
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `modelValue` | String | `''` | HTML content |
| `placeholder` | String | `'Write something...'` | Placeholder text |
| `editorClass` | String | `''` | Additional editor classes |

### Events

| Event | Payload | Description |
|-------|---------|-------------|
| `update:modelValue` | `string` | Content changed |

## Toolbar Features

| Button | Action |
|--------|--------|
| **B** | Bold text |
| *I* | Italic text |
| U | Underline text |
| List | Bullet list |
| 123 | Numbered list |

## Features

- **WYSIWYG Editing**: See formatting as you type
- **Toolbar**: Quick formatting buttons
- **Paste Handling**: Strips formatting from pasted text
- **Placeholder**: Shown when empty
- **Prose Styling**: Clean typography

## Styling

Uses Tailwind CSS:
- Gray toolbar background
- Border around editor
- Prose typography styling
- Focus ring on editor

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x

## License

MIT License
