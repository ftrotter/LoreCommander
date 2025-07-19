#!/bin/bash
set -e

echo "host all all all md5" >> "$PGDATA/pg_hba.conf"
echo "listen_addresses = '*'" >> "$PGDATA/postgresql.conf"
