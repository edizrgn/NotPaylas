<?php
declare(strict_types=1);

function getMaxUploadMb(): int
{
    return 25;
}

function getMaxUploadBytes(): int
{
    return getMaxUploadMb() * 1024 * 1024;
}
