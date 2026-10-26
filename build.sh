#!/usr/bin/env bash
# Rebuild css/adminer-<env>.css from the upstream theme (https://github.com/OverflowHayden/adminer-theme) plus banner.css.
# Usage: ./build.sh [git ref]   (defaults to master)
set -euo pipefail

cd "$(dirname "$0")"
ref="${1:-master}"
upstream="$(curl -fsSL "https://raw.githubusercontent.com/OverflowHayden/adminer-theme/${ref}/dist/adminer.css")"

build() {
    local env="$1" label="$2" color="$3"
    {
        printf '%s\n' "$upstream"
        sed -e "s/__LABEL__/${label}/" -e "s/__COLOR__/${color}/" banner.css
    } > "css/adminer-${env}.css"
}

build staging Staging '#ffc105'
build acceptance Acceptance '#499249'
build production Production '#d33131'
