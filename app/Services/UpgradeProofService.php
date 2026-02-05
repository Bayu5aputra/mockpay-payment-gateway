<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpgradeProofService
{
    public function store(UploadedFile $file): array
    {
        $raw = file_get_contents($file->getRealPath());
        $compressed = gzencode($raw, 9);
        $encrypted = Crypt::encryptString(base64_encode($compressed));

        $path = $this->buildPath($file->getClientOriginalExtension());
        Storage::disk('local')->put($path, $encrypted);

        return [
            'proof_path' => $path,
            'proof_original_name' => $file->getClientOriginalName(),
            'proof_mime' => $file->getClientMimeType(),
            'proof_size' => $file->getSize(),
            'proof_hash' => hash_file('sha256', $file->getRealPath()),
        ];
    }

    public function retrieveDecrypted(string $path): string
    {
        $encrypted = Storage::disk('local')->get($path);
        $decoded = base64_decode(Crypt::decryptString($encrypted));
        return gzdecode($decoded);
    }

    private function buildPath(string $extension): string
    {
        $datePath = now()->format('Y/m/d');
        $filename = 'proof_' . Str::uuid()->toString() . '.' . ltrim($extension, '.');
        return "upgrade-proofs/{$datePath}/{$filename}.enc";
    }
}
