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
