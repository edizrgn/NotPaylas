<?php
declare(strict_types=1);

function getNoteStorageDir(): string
{
    $configuredPath = getenv('NOTBUL_NOTE_STORAGE_DIR');
    if (is_string($configuredPath) && trim($configuredPath) !== '') {
        return rtrim($configuredPath, "/\\") . DIRECTORY_SEPARATOR;
    }

    return '/var/lib/notbul/notes/';
}

function resolveNoteStoragePath(array $note): ?string
{
    $storagePath = trim((string)($note['storage_path'] ?? ''));
    if ($storagePath === '' && !empty($note['stored_filename'])) {
        $storagePath = (string)$note['stored_filename'];
    }

    $storagePath = str_replace('\\', '/', $storagePath);
    $storagePath = ltrim($storagePath, '/');

    if ($storagePath === '' || strpos($storagePath, '..') !== false) {
        return null;
    }

    return $storagePath;
}

function buildNoteAbsolutePath(string $storagePath): string
{
    return rtrim(getNoteStorageDir(), "/\\") . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $storagePath);
}
