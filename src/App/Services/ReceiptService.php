<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;
use App\Config\Paths;

class ReceiptService
{
    public function __construct(private Database $db) {
    }

    public function validateFile(?array $file) {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            throw new ValidationException([
                    'receipt' => ['Transferencia do arquivo falhou.']
                ]);
        }

        $maxFileSizeMB = 5 * 1024 * 1024;

        if ($file['size'] > $maxFileSizeMB) {
            throw new ValidationException([
                'receipt' => ['O arquivo excede o tamanho maximo de 5MB.']
            ]);
        }

        $originalFileName = $file['name'];

        if (!preg_match('/^[a-zA-Z0-9\s._-]+$/', $originalFileName)) {
            throw new ValidationException([
                'receipt' => ['O nome do arquivo e invalido.']
            ]);
        }

        $clientMimeType = $file['type'];
        $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/avif', 'application/pdf'];

        if (!in_array($clientMimeType, $allowedMimeTypes)) {
            throw new ValidationException([
                'receipt' => ['O tipo de arquivo e invalido.']
            ]);
        }
    }

    public function upload(array $file, int $transaction) {
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newFilename = bin2hex(random_bytes(16)) . '.' . $fileExtension;

        $uploadPath = Paths::STORAGE_UPLOADS . "/" . $newFilename;

        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            throw new ValidationException([
                'receipt' => ['Transferencia do arquivo falhou.']
            ]);
        }

        $this->db->query(
            "INSERT INTO receipts(
                     transaction_id, original_filename, storage_filename, media_type
                   )
                   VALUES(
                          :transaction_id, :original_filename, :storage_filename, :media_type
                   )",
            [
                'transaction_id' => $transaction,
                'original_filename' => $file['name'],
                'storage_filename' => $newFilename,
                'media_type' => $file['type']
            ]
        );
    }

    public function getReceipt(string $id) {
        $receipt =$this->db->query(
            "SELECT * FROM receipts WHERE id = :id",
            ['id' => $id]
        )->find();

        return $receipt;
    }

    public function read(array $receipt) {
        $filePath = Paths::STORAGE_UPLOADS . "/" . $receipt['storage_filename'];

        if (!file_exists($filePath)) {
            redirectTo("/");
        }

        header("Content-Disposition: inline; filename={$receipt['original_filename']}");
        header("Content-Type: {$receipt['media_type']}");

        readfile($filePath);
    }

    public function delete(array $receipt) {
        $filePath = Paths::STORAGE_UPLOADS . "/" . $receipt['storage_filename'];

        unlink($filePath);

        $this->db->query(
            "DELETE FROM receipts WHERE id = :id",
            ['id' => $receipt['id']]
        );

        redirectTo('/');
    }
}