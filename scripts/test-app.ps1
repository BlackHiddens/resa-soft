param(
    [switch]$WithMigrate
)

$ErrorActionPreference = 'Stop'
Set-Location (Join-Path $PSScriptRoot '..')

function Resolve-PHP {
    if (Get-Command php -ErrorAction SilentlyContinue) {
        return 'php'
    }

    $candidates = @(
        'C:\Program Files\PHP\php-8.5.3\php.exe',
        'C:\Program Files\PHP\php\php.exe'
    )

    foreach ($candidate in $candidates) {
        if (Test-Path $candidate) {
            return $candidate
        }
    }

    throw 'PHP introuvable. Ajoute php.exe au PATH ou adapte scripts/test-app.ps1.'
}

$php = Resolve-PHP

if ($WithMigrate) {
    & $php artisan migrate:fresh --seed --force --ansi
}

& $php artisan test --ansi
exit $LASTEXITCODE
