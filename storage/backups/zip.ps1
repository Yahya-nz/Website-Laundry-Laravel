
        Add-Type -A 'System.IO.Compression.FileSystem';
        [IO.Compression.ZipFile]::CreateFromDirectory('C:\laundry', 'C:\laundry\storage\backups/backup_2025-11-27_09-22-10.zip');
    