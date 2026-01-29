
        Add-Type -A 'System.IO.Compression.FileSystem';
        $zip = [IO.Compression.ZipFile]::Open('C:\laundry\storage\backups/backup_2025-11-27_09-22-10.zip','Update');
        $entry = $zip.CreateEntryFromFile('C:\laundry\storage\backups/db_2025-11-27_09-22-10.sql','db_2025-11-27_09-22-10.sql');
        $zip.Dispose();
    