<?php

echo "=== PHP UPLOAD CONFIGURATION ===\n";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "post_max_size: " . ini_get('post_max_size') . "\n";
echo "max_file_uploads: " . ini_get('max_file_uploads') . "\n";
echo "memory_limit: " . ini_get('memory_limit') . "\n";

echo "\n=== STORAGE DIRECTORY ===\n";
$uploadDir = __DIR__ . '/storage/app/public/uploads';
echo "Path: " . $uploadDir . "\n";
echo "Exists: " . (is_dir($uploadDir) ? 'YES' : 'NO') . "\n";
echo "Writable: " . (is_writable($uploadDir) ? 'YES' : 'NO') . "\n";

if (!is_writable($uploadDir)) {
    echo "\n⚠️ WARNING: Upload directory is NOT writable!\n";
    echo "Run: chmod 775 storage/app/public/uploads\n";
}

echo "\n=== FILES IN UPLOADS ===\n";
$files = glob($uploadDir . '/*');
echo "Total files: " . count($files) . "\n";
foreach ($files as $file) {
    echo "- " . basename($file) . " (" . filesize($file) . " bytes)\n";
}
