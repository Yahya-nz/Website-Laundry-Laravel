<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BackupLaundry extends Command
{
    protected $signature = 'laundry:backup';
    protected $description = 'Backup project dan database website laundry';

    public function handle()
    {
        $date = date('Y-m-d_H-i-s');

        // Lokasi penyimpanan ZIP dan SQL
        $backupPath = storage_path("backups/backup_$date.zip");
        $dbBackupPath = storage_path("backups/db_$date.sql");

        // Pastikan folder backup ada
        if (!is_dir(storage_path('backups'))) {
            mkdir(storage_path('backups'), 0777, true);
        }

        // Jika ZIP sudah ada (jarang terjadi), hapus dulu
        if (file_exists($backupPath)) {
            unlink($backupPath);
        }

        // === Backup database ===
        $db = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $pass = env('DB_PASSWORD');
        $host = env('DB_HOST');

        $command = "mysqldump -h $host -u $user -p$pass $db > \"$dbBackupPath\"";
        system($command);

        // === Buat ZIP menggunakan PowerShell ===
        $projectDir = base_path();
        $psScript = "
        Add-Type -A 'System.IO.Compression.FileSystem';
        [IO.Compression.ZipFile]::CreateFromDirectory('$projectDir', '$backupPath');
    ";
        file_put_contents(storage_path('backups/zip.ps1'), $psScript);

        // Jalankan PowerShell
        system("powershell -ExecutionPolicy Bypass -File " . storage_path('backups/zip.ps1'));

        // Tambahkan file SQL ke ZIP
        $addSql = "
        Add-Type -A 'System.IO.Compression.FileSystem';
        \$zip = [IO.Compression.ZipFile]::Open('$backupPath','Update');
        \$entry = \$zip.CreateEntryFromFile('$dbBackupPath','db_$date.sql');
        \$zip.Dispose();
    ";
        file_put_contents(storage_path('backups/addsql.ps1'), $addSql);

        system("powershell -ExecutionPolicy Bypass -File " . storage_path('backups/addsql.ps1'));

        // Hapus file SQL setelah dimasukkan ke ZIP
        unlink($dbBackupPath);

        $this->info("Backup selesai: $backupPath");
    }
}
