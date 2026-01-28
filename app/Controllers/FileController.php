<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FileController extends Controller
{
    /**
     * Serve uploaded files from writable/uploads directory
     * Example: /file/uploads/profile_1_1769587065.jpg
     */
    public function uploads($filename = null)
    {
        if (!$filename) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Security: Only allow alphanumeric, underscores, and dots
        if (!preg_match('/^[a-zA-Z0-9._-]+$/', $filename)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $filepath = WRITEPATH . 'uploads/' . $filename;

        // Check if file exists
        if (!file_exists($filepath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get file info
        $filesize = filesize($filepath);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype = finfo_file($finfo, $filepath);
        finfo_close($finfo);

        // Set response headers
        return $this->response
            ->setHeader('Content-Type', $mimetype)
            ->setHeader('Content-Length', $filesize)
            ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
            ->setHeader('Cache-Control', 'public, max-age=86400')
            ->setBody(file_get_contents($filepath));
    }
}
