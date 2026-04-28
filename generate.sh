#!/usr/bin/env bash
set -euo pipefail

echo "Regenerating REST clients via Kiota..."

kiota generate -l php \
  -d specs/sell_feed_v1_oas3.yaml \
  -c SellLeadsApiClient \
  -n 'EBay\OffersAndLeads\Generated\SellLeads' \
  -o src/Generated/SellLeads \
  --ebc --co

echo "Done. Run 'composer dump-autoload' if new namespaces were added."
