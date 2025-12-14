<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'

interface Props {
  modelValue?: string
  placeholder?: string
  autofocus?: boolean
  disabled?: boolean
  uploadEndpoint?: string | null
}

const props = withDefaults(defineProps<Props>(), {
  modelValue: '',
  placeholder: 'Write something...',
  autofocus: false,
  disabled: false,
  uploadEndpoint: null,
})

const emit = defineEmits<{
  'update:modelValue': [value: string]
  'change': [value: string]
  'focus': []
  'blur': []
  'file-accept': [file: File]
  'attachment-add': [attachment: any]
}>()

const editorId = `editor-${Math.random().toString(36).substring(7)}`
const inputRef = ref<HTMLInputElement | null>(null)
const editorRef = ref<HTMLElement | null>(null)
const isReady = ref(false)

function handleChange(event: Event) {
  const target = event.target as HTMLElement
  const value = target.innerHTML
  emit('update:modelValue', value)
  emit('change', value)
}

function handleFocus() {
  emit('focus')
}

function handleBlur() {
  emit('blur')
}

function handleFileAccept(event: Event) {
  const customEvent = event as CustomEvent
  if (customEvent.file) {
    emit('file-accept', customEvent.file)
  }
}

function handleAttachmentAdd(event: Event) {
  const customEvent = event as CustomEvent
  if (customEvent.attachment) {
    emit('attachment-add', customEvent.attachment)

    if (props.uploadEndpoint && customEvent.attachment.file) {
      uploadFile(customEvent.attachment)
    }
  }
}

async function uploadFile(attachment: any) {
  if (!props.uploadEndpoint) return

  const formData = new FormData()
  formData.append('file', attachment.file)

  try {
    const response = await fetch(props.uploadEndpoint, {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
      },
    })

    if (response.ok) {
      const data = await response.json()
      attachment.setAttributes({
        url: data.url,
        href: data.url,
      })
    }
  } catch (error) {
    console.error('Upload failed:', error)
  }
}

onMounted(() => {
  if (inputRef.value) {
    inputRef.value.value = props.modelValue
  }
  isReady.value = true
})

watch(() => props.modelValue, (newValue) => {
  if (inputRef.value && editorRef.value) {
    const editor = editorRef.value as any
    if (editor.editor && editor.editor.getDocument().toString() !== newValue) {
      inputRef.value.value = newValue
      editor.editor.loadHTML(newValue)
    }
  }
})
</script>

<template>
  <div class="ld-editor">
    <input
      ref="inputRef"
      type="hidden"
      :id="editorId"
    >
    <trix-editor
      v-if="isReady"
      ref="editorRef"
      :input="editorId"
      :placeholder="placeholder"
      :autofocus="autofocus || undefined"
      :disabled="disabled || undefined"
      @trix-change="handleChange"
      @trix-focus="handleFocus"
      @trix-blur="handleBlur"
      @trix-file-accept="handleFileAccept"
      @trix-attachment-add="handleAttachmentAdd"
      class="prose prose-sm max-w-none focus:outline-none min-h-[200px] p-3 border border-gray-300 rounded-md"
    ></trix-editor>
  </div>
</template>

<style>
@import 'https://unpkg.com/trix@2.0.0/dist/trix.css';

trix-toolbar .trix-button-group {
  margin-bottom: 0;
}

trix-editor {
  min-height: 200px;
}

trix-editor:empty:not(:focus)::before {
  color: #9ca3af;
}
</style>
