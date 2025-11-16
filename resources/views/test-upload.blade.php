<!DOCTYPE html>
<html>
<head>
    <title>Test Upload</title>
</head>
<body>
    <h1>Test Upload Foto</h1>
    
    @if(session('success'))
        <div style="background: green; color: white; padding: 10px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: red; color: white; padding: 10px;">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background: orange; color: white; padding: 10px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('test.upload.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Pilih Foto:</label><br>
            <input type="file" name="foto" accept="image/*" required>
        </div>
        <br>
        <button type="submit">Upload Test</button>
    </form>

    <hr>
    <h2>Files in uploads folder:</h2>
    <ul>
        @php
            $files = glob(storage_path('app/public/uploads/*'));
        @endphp
        @if(count($files) > 0)
            @foreach($files as $file)
                <li>{{ basename($file) }} ({{ filesize($file) }} bytes)</li>
            @endforeach
        @else
            <li>No files found</li>
        @endif
    </ul>
</body>
</html>
