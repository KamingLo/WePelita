<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Ganti CDN dengan -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}"></script>
    <title>Trix Editor in Laravel</title>
    
    <!-- Trix Editor CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    
    <style>
        /* Custom CSS untuk Trix Editor */
        .trix-content {
            min-height: 200px;
            background-color: white;
            border-radius: 0.375rem;
            padding: 1rem;
        }
        
        .trix-button-group {
            background-color: #f8f9fa;
            border-radius: 0.375rem;
        }
        
        .editor-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .editor-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .form-actions {
            margin-top: 1rem;
            text-align: right;
        }
        
        .btn-submit {
            background-color: #4f46e5;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
        }
        
        .btn-submit:hover {
            background-color: #4338ca;
        }
    </style>
</head>
<body>
    <div class="editor-container">
        <div class="editor-header">
            <h1>Trix Editor in Laravel</h1>
        </div>
        
        <form action="{{ route('editor.store') }}" method="POST">
            @csrf
            
            <input type="hidden" id="content" name="content">
            
            <trix-editor input="content" class="trix-content"></trix-editor>
            
            <div class="form-actions">
                <button type="submit" class="btn-submit">Submit</button>
            </div>
        </form>
    </div>
    
    <!-- Trix Editor JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    
    <script>
        // Anda bisa menambahkan custom JavaScript untuk Trix di sini
        document.addEventListener('trix-initialize', function(event) {
            // Event listener untuk Trix
        });
    </script>
</body>
</html>