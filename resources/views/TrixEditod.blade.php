@props(['id' => Str::random(5), 'value' => ''])

@push('styles')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<style>
    .trix-button-group--file-tools {
        display: none !important;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpush

<div
    x-data="{
        value: @js($value),
        setValue() {
            let element = document.getElementById('trix-editor-' + '{{ $id }}');
            element.editor.loadHTML(this.value);
        }
    }"
    x-init="setValue()"
    wire:ignore
>
    <input
        id="trix-input-{{ $id }}"
        type="hidden"
        name="{{ $id }}"
        value="{{ $value }}"
    >
    <trix-editor
        id="trix-editor-{{ $id }}"
        input="trix-input-{{ $id }}"
        class="trix-content"
        x-on:trix-change="$dispatch('input', $event.target.value)"
        x-on:trix-file-accept.prevent
        x-on:trix-attachment-add.prevent="alert('Upload file tidak diizinkan')"
    ></trix-editor>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>