#!/bin/bash

# === CONFIGURASI ===
DB_NAME="nama_database"
DB_USER="root"
DB_PASSWORD=""
DB_HOST="127.0.0.1"
PROJECT_DIR="/path/ke/project/laundry"
BACKUP_DIR="$PROJECT_DIR/storage/backups"
DATE=$(date +"%Y-%m-%d_%H-%M-%S")
BACKUP_FILE="backup_$DATE.zip"

# === Membuat folder backup jika belum ada ===
mkdir -p $BACKUP_DIR

# === Backup database MySQL ===
echo "Membuat backup database..."
mysqldump -h $DB_HOST -u $DB_USER -p$DB_PASSWORD $DB_NAME > $BACKUP_DIR/db_$DATE.sql

# === Copy file project ===
echo "Mengemas seluruh project..."
cd $PROJECT_DIR
zip -r $BACKUP_DIR/$BACKUP_FILE . -x "vendor/*" "node_modules/*" "storage/logs/*"

# === Tambahkan file SQL ke dalam ZIP ===
cd $BACKUP_DIR
zip -u $BACKUP_FILE db_$DATE.sql

# === Hapus SQL setelah digabung ===
rm db_$DATE.sql

echo "Backup selesai! File tersimpan di $BACKUP_DIR/$BACKUP_FILE"
