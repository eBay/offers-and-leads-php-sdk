#!/usr/bin/env bash

# Copyright 2026 eBay Inc.
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#     http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

KIOTA_VERSION=$(kiota --version 2>/dev/null | cut -d'+' -f1)
if [ "$KIOTA_VERSION" != "1.35.0" ]; then
  echo "Error: kiota 1.35.0 required, found '${KIOTA_VERSION:-not installed}'"
  echo "See https://learn.microsoft.com/en-us/openapi/kiota/install for installation options."
  exit 1
fi

echo "Regenerating REST clients via Kiota..."
rm -rf src/Generated

kiota generate -l php \
  -d specs/openapi/classified-leads.json \
  -c ClassifiedLeadsApiClient \
  -n 'EBay\OffersAndLeads\Generated\ClassifiedLeads' \
  -o src/Generated/ClassifiedLeads \
  --ebc --co

kiota generate -l php \
  -d specs/openapi/negotiation.json \
  -c NegotiationApiClient \
  -n 'EBay\OffersAndLeads\Generated\Negotiation' \
  -o src/Generated/Negotiation \
  --ebc --co

echo "Adding license headers to generated files..."
"$SCRIPT_DIR/add-license-headers.sh" "$SCRIPT_DIR/src/Generated"

echo "Done. Run 'composer dump-autoload' if new namespaces were added."
