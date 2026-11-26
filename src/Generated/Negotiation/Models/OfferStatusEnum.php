<?php

// Copyright 2026 eBay Inc.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

namespace EBay\OffersAndLeads\Generated\Negotiation\Models;

use Microsoft\Kiota\Abstractions\Enum;

class OfferStatusEnum extends Enum {
    public const P_E_N_D_I_N_G = "PENDING";
    public const R_E_T_R_A_C_T_E_D = "RETRACTED";
    public const E_X_P_I_R_E_D = "EXPIRED";
    public const C_A_N_C_E_L_L_E_D = "CANCELLED";
    public const C_O_U_N_T_E_R_E_D = "COUNTERED";
    public const D_E_C_L_I_N_E_D = "DECLINED";
    public const A_U_T_O__D_E_C_L_I_N_E_D = "AUTO_DECLINED";
    public const A_U_T_O__A_C_C_E_P_T_E_D = "AUTO_ACCEPTED";
    public const A_C_C_E_P_T_E_D = "ACCEPTED";
}
