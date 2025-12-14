<template>
  <div class="border border-gray-300 rounded-lg overflow-hidden">
    <div class="flex items-center gap-1 p-2 bg-gray-50 border-b">
      <button v-for="btn in toolbarButtons" :key="btn.cmd" @click="execCommand(btn.cmd)" :title="btn.title" class="p-2 hover:bg-gray-200 rounded">
        <span v-html="btn.icon"></span>
      </button>
    </div>
    <div
      ref="editorRef"
      contenteditable="true"
      @input="handleInput"
      @paste="handlePaste"
      :class="['min-h-[200px] p-4 focus:outline-none prose max-w-none', editorClass]"
      :placeholder="placeholder"
    ></div>
  </div>
</template>

<script>
import { ref, onMounted, watch } from 'vue';

export default {
  name: 'SbEditor',
  props: {
    modelValue: { type: String, default: '' },
    placeholder: { type: String, default: 'Write something...' },
    editorClass: { type: String, default: '' }
  },
  emits: ['update:modelValue'],
  setup(props, { emit }) {
    const editorRef = ref(null);

    const toolbarButtons = [
      { cmd: 'bold', title: 'Bold', icon: '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4a1 1 0 011-1h5a4 4 0 014 4 4 4 0 01-4 4H4a1 1 0 01-1-1V4zm3 3h2a1 1 0 100-2H6v2zm0 4h3a1 1 0 100-2H6v2z"/><path d="M4 13h6a4 4 0 014 4 4 4 0 01-4 4H4a1 1 0 01-1-1v-6a1 1 0 011-1zm2 3h4a1 1 0 100-2H6v2z"/></svg>' },
      { cmd: 'italic', title: 'Italic', icon: '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M8 4h6l-1 2H9l-4 8h4l-1 2H2l1-2h2l4-8H7l1-2z"/></svg>' },
      { cmd: 'underline', title: 'Underline', icon: '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3v7a5 5 0 1010 0V3h-2v7a3 3 0 11-6 0V3H5zM3 17h14v2H3v-2z"/></svg>' },
      { cmd: 'insertUnorderedList', title: 'Bullet List', icon: '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4h2v2H4V4zm4 0h8v2H8V4zM4 9h2v2H4V9zm4 0h8v2H8V9zm-4 5h2v2H4v-2zm4 0h8v2H8v-2z"/></svg>' },
      { cmd: 'insertOrderedList', title: 'Numbered List', icon: '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M3 4h2v3H4V5H3V4zm0 5h2v1h1v1H4v1h2v1H3v-4zm0 6h3v1H4v1h2v1H3v-3zm5-11h8v2H8V4zm0 5h8v2H8V9zm0 5h8v2H8v-2z"/></svg>' }
    ];

    const execCommand = (cmd) => {
      document.execCommand(cmd, false, null);
      editorRef.value?.focus();
    };

    const handleInput = () => {
      emit('update:modelValue', editorRef.value?.innerHTML || '');
    };

    const handlePaste = (e) => {
      e.preventDefault();
      const text = e.clipboardData?.getData('text/plain') || '';
      document.execCommand('insertText', false, text);
    };

    onMounted(() => {
      if (editorRef.value && props.modelValue) {
        editorRef.value.innerHTML = props.modelValue;
      }
    });

    watch(() => props.modelValue, (val) => {
      if (editorRef.value && editorRef.value.innerHTML !== val) {
        editorRef.value.innerHTML = val;
      }
    });

    return { editorRef, toolbarButtons, execCommand, handleInput, handlePaste };
  }
};
</script>

<style scoped>
[contenteditable]:empty:before {
  content: attr(placeholder);
  color: #9ca3af;
}
</style>
