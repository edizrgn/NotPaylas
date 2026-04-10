<?php
declare(strict_types=1);

/**
 * Read configuration values from process environment first, then .env files.
 */
function envValue(string $key, ?string $default = null): ?string
{
    $runtimeValue = getenv($key);
    if ($runtimeValue !== false && $runtimeValue !== '') {
        return $runtimeValue;
    }

    static $envCache = null;
    if ($envCache === null) {
        $envCache = [];
        $envCandidates = [];
        $configuredPath = getenv('NOTBUL_ENV_FILE');
        if (is_string($configuredPath) && $configuredPath !== '') {
            $envCandidates[] = $configuredPath;
        }
        $envCandidates[] = '/etc/notbul/.env';
        $envCandidates[] = dirname(__DIR__) . '/.env';

        $envPath = null;
        foreach ($envCandidates as $candidatePath) {
            if (is_readable($candidatePath)) {
                $envPath = $candidatePath;
                break;
            }
        }

        if ($envPath !== null) {
            $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if ($lines !== false) {
                foreach ($lines as $line) {
                    $line = trim($line);
                    if ($line === '' || str_starts_with($line, '#')) {
                        continue;
                    }

                    $separatorPosition = strpos($line, '=');
                    if ($separatorPosition === false) {
                        continue;
                    }

                    $envKey = trim(substr($line, 0, $separatorPosition));
                    $envRawValue = trim(substr($line, $separatorPosition + 1));

                    if ($envRawValue !== '') {
                        $firstChar = $envRawValue[0];
                        $lastChar = $envRawValue[strlen($envRawValue) - 1];
                        if (($firstChar === '"' && $lastChar === '"') || ($firstChar === "'" && $lastChar === "'")) {
                            $envRawValue = substr($envRawValue, 1, -1);
                        }
                    }

                    if ($envKey !== '') {
                        $envCache[$envKey] = $envRawValue;
                    }
                }
            }
        }
    }

    if (array_key_exists($key, $envCache) && $envCache[$key] !== '') {
        return $envCache[$key];
    }

    return $default;
}
