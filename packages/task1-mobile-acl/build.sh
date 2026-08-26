#!/usr/bin/env bash
# Build the installable Module Loader ZIP for Task 1 (mobile ACL revert to default).
# The ZIP must contain manifest.php and Files/ at its ROOT — hence we zip from here.
set -euo pipefail
cd "$(dirname "$0")"

VERSION=$(grep -oE "'version'\s*=>\s*'[^']+'" manifest.php | grep -oE "[0-9]+\.[0-9]+\.[0-9]+" | head -1)
OUT="task1-mobile-acl-revert-${VERSION:-1.0.0}.zip"

rm -f "$OUT"
# Only manifest.php + Files/ go into the package (never reference/, README, build.sh).
zip -r "$OUT" manifest.php Files >/dev/null
echo "Built $OUT"
unzip -l "$OUT"
