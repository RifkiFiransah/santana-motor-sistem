<?php

namespace App\Controllers;

class ImageController extends BaseController
{
    /**
     * Serve image files securely
     * Validates filename and serves image with proper headers
     */
    public function serve($filename)
    {
        // Sanitize filename - allow only alphanumeric, underscore, hyphen, and dot
        if (!preg_match('/^[a-zA-Z0-9._-]+$/', $filename)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Invalid file');
        }

        // Build full path
        $filepath = WRITEPATH . 'uploads/motorcycles/' . $filename;

        // Security checks
        if (!file_exists($filepath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File not found');
        }

        // Verify file is within uploads directory (prevent directory traversal)
        $real_path = realpath($filepath);
        $upload_dir = realpath(WRITEPATH . 'uploads/motorcycles/');
        
        if ($real_path === false || strpos($real_path, $upload_dir) !== 0) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Invalid file path');
        }

        // Get file info
        $mime = mime_content_type($filepath);
        $filesize = filesize($filepath);

        // Only allow image types
        $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
        if (!in_array($mime, $allowed_mimes)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Invalid file type');
        }

        // Set headers
        header('Content-Type: ' . $mime);
        header('Content-Length: ' . $filesize);
        header('Cache-Control: public, max-age=2592000'); // 30 days cache
        header('Pragma: public');
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 2592000) . ' GMT');

        // Prevent inline display of potentially dangerous files
        header('Content-Disposition: inline; filename="' . basename($filepath) . '"');

        // Send file
        readfile($filepath);
        exit;
    }
}
