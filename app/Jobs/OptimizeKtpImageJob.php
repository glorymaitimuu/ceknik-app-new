<?php

namespace App\Jobs;

use App\Models\PengajuanPesertaRentan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;

class OptimizeKtpImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The pengajuan instance.
     *
     * @var \App\Models\PengajuanPesertaRentan
     */
    public $pengajuan;

    /**
     * Create a new job instance.
     */
    public function __construct(PengajuanPesertaRentan $pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Re-fetch model in case it was updated
        $this->pengajuan->refresh();
        
        $originalPath = $this->pengajuan->file_ktp;

        if (!Storage::disk('local')->exists($originalPath)) {
            logger()->warning('OptimizeKtpImageJob: File not found at ' . $originalPath);
            return;
        }

        $fullPath = Storage::disk('local')->path($originalPath);
        
        // Skip if already optimized (avoid infinite loop or redundant processing)
        if (strpos($originalPath, '_optimized') !== false) {
            return;
        }

        try {
            // Tentukan jalur file baru (WebP)
            $filename = pathinfo($originalPath, PATHINFO_FILENAME);
            $webpPath = "uploads/ktp/{$filename}_optimized.webp";
            $webpFullPath = Storage::disk('local')->path($webpPath);

            // Percobaan 1: Konversi ke WebP dengan pembatasan resolusi (Max 1500px)
            Image::load($fullPath)
                ->width(1500) // Batasi resolusi agar tidak membuat GD crash
                ->format('webp')
                ->quality(50)
                ->save($webpFullPath);

            // Update database dan hapus file lama
            $this->pengajuan->update(['file_ktp' => $webpPath]);
            Storage::disk('local')->delete($originalPath);
            
        } catch (\Throwable $e) {
            // Berhasil menangkap Fatal Error atau Exception
            logger()->warning('WebP conversion failed for ID ' . $this->pengajuan->id . '. Error: ' . $e->getMessage() . '. Falling back to JPG.');

            try {
                // Percobaan 2 (Fallback): Konversi ke JPG terkompresi
                $jpgPath = "uploads/ktp/{$filename}_optimized.jpg";
                $jpgFullPath = Storage::disk('local')->path($jpgPath);

                Image::load($fullPath)
                    ->width(1500)
                    ->format('jpg')
                    ->quality(60)
                    ->save($jpgFullPath);

                $this->pengajuan->update(['file_ktp' => $jpgPath]);
                Storage::disk('local')->delete($originalPath);
                
            } catch (\Throwable $fallbackError) {
                // Kegagalan total: Biarkan file asli apa adanya
                logger()->error('Total image optimization failure for ID ' . $this->pengajuan->id . ': ' . $fallbackError->getMessage());
            }
        }
    }
}
