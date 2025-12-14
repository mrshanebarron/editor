<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Trix CDN URL
    |--------------------------------------------------------------------------
    |
    | The URL to load Trix editor CSS and JS from CDN.
    |
    */
    'trix_css_url' => 'https://unpkg.com/trix@2.0.0/dist/trix.css',
    'trix_js_url' => 'https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js',

    /*
    |--------------------------------------------------------------------------
    | Default Placeholder
    |--------------------------------------------------------------------------
    |
    | The default placeholder text for the editor.
    |
    */
    'placeholder' => 'Write something...',

    /*
    |--------------------------------------------------------------------------
    | Autofocus
    |--------------------------------------------------------------------------
    |
    | Whether the editor should autofocus by default.
    |
    */
    'autofocus' => false,

    /*
    |--------------------------------------------------------------------------
    | Upload Endpoint
    |--------------------------------------------------------------------------
    |
    | The default endpoint for file uploads. Set to null to disable uploads.
    |
    */
    'upload_endpoint' => null,

    /*
    |--------------------------------------------------------------------------
    | Accepted File Types
    |--------------------------------------------------------------------------
    |
    | The file types accepted for uploads.
    |
    */
    'accepted_file_types' => ['image/png', 'image/jpeg', 'image/gif', 'image/webp'],

    /*
    |--------------------------------------------------------------------------
    | Max File Size
    |--------------------------------------------------------------------------
    |
    | Maximum file size in bytes (default: 10MB).
    |
    */
    'max_file_size' => 10 * 1024 * 1024,
];
