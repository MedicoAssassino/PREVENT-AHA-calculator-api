<?php
namespace HClean\PreventCalcApi;
class PreventCalculatorApi
{
    // Coefficients extracted from Tables S12A to S12E of the AHA 2023 article supplement
    private array $models = [
        'base' => [ // Table S12A
            'female' => [
                'cvd' => ['age' => 0.7939329, 'non_hdl' => 0.0305239, 'hdl' => -0.1606857, 'sbp_min' => -0.2394003, 'sbp_max' => 0.3600781, 'dm' => 0.8667604, 'smoke' => 0.5360739, 'egfr_min' => 0.6045917, 'egfr_max' => 0.0433769, 'bp_meds' => 0.3151672, 'statin' => -0.1477655, 'tx_sbp' => -0.0663612, 'tx_non_hdl' => 0.1197879, 'age_non_hdl' => -0.0819715, 'age_hdl' => 0.0306769, 'age_sbp' => -0.0946348, 'age_dm' => -0.27057, 'age_smoke' => -0.078715, 'age_egfr' => -0.1637806, 'intercept' => -3.307728],
                'ascvd' => ['age' => 0.719883, 'non_hdl' => 0.1176967, 'hdl' => -0.151185, 'sbp_min' => -0.0835358, 'sbp_max' => 0.3592852, 'dm' => 0.8348585, 'smoke' => 0.4831078, 'egfr_min' => 0.4864619, 'egfr_max' => 0.0397779, 'bp_meds' => 0.2265309, 'statin' => -0.0592374, 'tx_sbp' => -0.0395762, 'tx_non_hdl' => 0.0844423, 'age_non_hdl' => -0.0567839, 'age_hdl' => 0.0325692, 'age_sbp' => -0.1035985, 'age_dm' => -0.2417542, 'age_smoke' => -0.0791142, 'age_egfr' => -0.1671492, 'intercept' => -3.819975],
                'hf' => ['age' => 0.8998235, 'sbp_min' => -0.4559771, 'sbp_max' => 0.3576505, 'dm' => 1.038346, 'smoke' => 0.583916, 'bmi_min' => -0.0072294, 'bmi_max' => 0.2997706, 'egfr_min' => 0.7451638, 'egfr_max' => 0.0557087, 'bp_meds' => 0.3534442, 'tx_sbp' => -0.0981511, 'age_sbp' => -0.0946663, 'age_dm' => -0.3581041, 'age_smoke' => -0.1159453, 'age_bmi' => -0.003878, 'age_egfr' => -0.1884289, 'intercept' => -4.310409]
            ],
            'male' => [
                'cvd' => ['age' => 0.7688528, 'non_hdl' => 0.0736174, 'hdl' => -0.0954431, 'sbp_min' => -0.4347345, 'sbp_max' => 0.3362658, 'dm' => 0.7692857, 'smoke' => 0.4386871, 'egfr_min' => 0.5378979, 'egfr_max' => 0.0164827, 'bp_meds' => 0.288879, 'statin' => -0.1337349, 'tx_sbp' => -0.0475924, 'tx_non_hdl' => 0.150273, 'age_non_hdl' => -0.0517874, 'age_hdl' => 0.0191169, 'age_sbp' => -0.1049477, 'age_dm' => -0.2251948, 'age_smoke' => -0.0895067, 'age_egfr' => -0.1543702, 'intercept' => -3.031168],
                'ascvd' => ['age' => 0.7099847, 'non_hdl' => 0.1658663, 'hdl' => -0.1144285, 'sbp_min' => -0.2837212, 'sbp_max' => 0.3239977, 'dm' => 0.7189597, 'smoke' => 0.3956973, 'egfr_min' => 0.3690075, 'egfr_max' => 0.0203619, 'bp_meds' => 0.2036522, 'statin' => -0.0865581, 'tx_sbp' => -0.0322916, 'tx_non_hdl' => 0.114563, 'age_non_hdl' => -0.0300005, 'age_hdl' => 0.0232747, 'age_sbp' => -0.0927024, 'age_dm' => -0.2018525, 'age_smoke' => -0.0970527, 'age_egfr' => -0.1217081, 'intercept' => -3.500655],
                'hf' => ['age' => 0.8972642, 'sbp_min' => -0.6811466, 'sbp_max' => 0.3634461, 'dm' => 0.923776, 'smoke' => 0.5023736, 'bmi_min' => -0.0485841, 'bmi_max' => 0.3726929, 'egfr_min' => 0.6926917, 'egfr_max' => 0.0251827, 'bp_meds' => 0.2980922, 'tx_sbp' => -0.0497731, 'age_sbp' => -0.1289201, 'age_dm' => -0.3040924, 'age_smoke' => -0.1401688, 'age_bmi' => 0.0068126, 'age_egfr' => -0.1797778, 'intercept' => -3.946391]
            ]
        ],
        'acr' => [ // Table S12B
            'female' => [
                'cvd' => ['age' => 0.7969249, 'non_hdl' => 0.0256635, 'hdl' => -0.1588107, 'sbp_min' => -0.2255701, 'sbp_max' => 0.3396649, 'dm' => 0.8047515, 'smoke' => 0.5285338, 'egfr_min' => 0.4803511, 'egfr_max' => 0.0434472, 'bp_meds' => 0.2985207, 'statin' => -0.1497787, 'tx_sbp' => -0.0742889, 'tx_non_hdl' => 0.106756, 'age_non_hdl' => -0.0778126, 'age_hdl' => 0.0306768, 'age_sbp' => -0.0907168, 'age_dm' => -0.2705122, 'age_smoke' => -0.0830564, 'age_egfr' => -0.1389249, 'uacr' => 0.1793037, 'intercept' => -3.738341],
                'ascvd' => ['age' => 0.7201999, 'non_hdl' => 0.1135771, 'hdl' => -0.1493506, 'sbp_min' => -0.0726677, 'sbp_max' => 0.3436259, 'dm' => 0.7773094, 'smoke' => 0.4746662, 'egfr_min' => 0.3824646, 'egfr_max' => 0.0394178, 'bp_meds' => 0.2125182, 'statin' => -0.0603046, 'tx_sbp' => -0.0466053, 'tx_non_hdl' => 0.0733118, 'age_non_hdl' => -0.053702, 'age_hdl' => 0.0326442, 'age_sbp' => -0.0987178, 'age_dm' => -0.2435555, 'age_smoke' => -0.0826941, 'age_egfr' => -0.1444737, 'uacr' => 0.1501217, 'intercept' => -4.186835],
                'hf' => ['age' => 0.9145975, 'sbp_min' => -0.4287843, 'sbp_max' => 0.3341857, 'dm' => 0.9576404, 'smoke' => 0.5835695, 'bmi_min' => -0.0097722, 'bmi_max' => 0.2974917, 'egfr_min' => 0.6300451, 'egfr_max' => 0.0519391, 'bp_meds' => 0.3345511, 'tx_sbp' => -0.1118939, 'age_sbp' => -0.0847953, 'age_dm' => -0.3547143, 'age_smoke' => -0.1220248, 'age_bmi' => -0.0053637, 'age_egfr' => -0.1610389, 'uacr' => 0.2197281, 'intercept' => -4.847587]
            ],
            'male' => [
                'cvd' => ['age' => 0.7768655, 'non_hdl' => 0.0659949, 'hdl' => -0.0951111, 'sbp_min' => -0.420667, 'sbp_max' => 0.3120151, 'dm' => 0.698521, 'smoke' => 0.4314669, 'egfr_min' => 0.3841364, 'egfr_max' => 0.009384, 'bp_meds' => 0.2676494, 'statin' => -0.1390966, 'tx_sbp' => -0.0579315, 'tx_non_hdl' => 0.1383719, 'age_non_hdl' => -0.0488332, 'age_hdl' => 0.0200406, 'age_sbp' => -0.102454, 'age_dm' => -0.2236355, 'age_smoke' => -0.089485, 'age_egfr' => -0.1321848, 'uacr' => 0.1887974, 'intercept' => -3.510705],
                'ascvd' => ['age' => 0.7141718, 'non_hdl' => 0.1602194, 'hdl' => -0.1139086, 'sbp_min' => -0.2719456, 'sbp_max' => 0.3058719, 'dm' => 0.6600631, 'smoke' => 0.3884022, 'egfr_min' => 0.2466316, 'egfr_max' => 0.0151852, 'bp_meds' => 0.186167, 'statin' => -0.0894395, 'tx_sbp' => -0.0411884, 'tx_non_hdl' => 0.1058212, 'age_non_hdl' => -0.028089, 'age_hdl' => 0.0240427, 'age_sbp' => -0.0912325, 'age_dm' => -0.2004894, 'age_smoke' => -0.096936, 'age_egfr' => -0.1022867, 'uacr' => 0.1510073, 'intercept' => -3.85146],
                'hf' => ['age' => 0.9111795, 'sbp_min' => -0.6693649, 'sbp_max' => 0.3290082, 'dm' => 0.8377655, 'smoke' => 0.4978917, 'bmi_min' => -0.042749, 'bmi_max' => 0.3624165, 'egfr_min' => 0.5075796, 'egfr_max' => 0.0137716, 'bp_meds' => 0.2739963, 'tx_sbp' => -0.0645712, 'age_sbp' => -0.1230039, 'age_dm' => -0.3013297, 'age_smoke' => -0.1410318, 'age_bmi' => 0.0021531, 'age_egfr' => -0.1548018, 'uacr' => 0.2306299, 'intercept' => -4.556907]
            ]
        ],
        'a1c' => [ // Table S12C
            'female' => [
                'cvd' => ['age' => 0.7858178, 'non_hdl' => 0.0194438, 'hdl' => -0.1521964, 'sbp_min' => -0.2296681, 'sbp_max' => 0.3465777, 'dm' => 0.5366241, 'smoke' => 0.5411682, 'egfr_min' => 0.5931898, 'egfr_max' => 0.0472458, 'bp_meds' => 0.3158567, 'statin' => -0.1535174, 'tx_sbp' => -0.0687752, 'tx_non_hdl' => 0.1054746, 'age_non_hdl' => -0.0761119, 'age_hdl' => 0.0307469, 'age_sbp' => -0.0905966, 'age_dm' => -0.2241857, 'age_smoke' => -0.080186, 'age_egfr' => -0.1667286, 'hba1c_dm' => 0.1338348, 'hba1c_no_dm' => 0.1622409, 'intercept' => -3.306162],
                'ascvd' => ['age' => 0.7111831, 'non_hdl' => 0.106797, 'hdl' => -0.1425745, 'sbp_min' => -0.0736824, 'sbp_max' => 0.3480844, 'dm' => 0.5112951, 'smoke' => 0.4880292, 'egfr_min' => 0.4754997, 'egfr_max' => 0.0438132, 'bp_meds' => 0.2259093, 'statin' => -0.0648872, 'tx_sbp' => -0.0437645, 'tx_non_hdl' => 0.0697082, 'age_non_hdl' => -0.0506382, 'age_hdl' => 0.0327475, 'age_sbp' => -0.0996442, 'age_dm' => -0.1924338, 'age_smoke' => -0.0803539, 'age_egfr' => -0.1682586, 'hba1c_dm' => 0.1339055, 'hba1c_no_dm' => 0.1596461, 'intercept' => -3.838746],
                'hf' => ['age' => 0.8997391, 'sbp_min' => -0.4422749, 'sbp_max' => 0.3378691, 'dm' => 0.681284, 'smoke' => 0.5886005, 'bmi_min' => -0.0148657, 'bmi_max' => 0.2958374, 'egfr_min' => 0.73447, 'egfr_max' => 0.05926, 'bp_meds' => 0.3543475, 'tx_sbp' => -0.1002139, 'age_sbp' => -0.0878765, 'age_dm' => -0.303684, 'age_smoke' => -0.1178943, 'age_bmi' => -0.008345, 'age_egfr' => -0.1912183, 'hba1c_dm' => 0.1856442, 'hba1c_no_dm' => 0.1833083, 'intercept' => -4.288225]
            ],
            'male' => [
                'cvd' => ['age' => 0.7699177, 'non_hdl' => 0.0605093, 'hdl' => -0.0888525, 'sbp_min' => -0.417713, 'sbp_max' => 0.3288657, 'dm' => 0.4759471, 'smoke' => 0.4385663, 'egfr_min' => 0.5334616, 'egfr_max' => 0.0206431, 'bp_meds' => 0.2917524, 'statin' => -0.1383313, 'tx_sbp' => -0.0482622, 'tx_non_hdl' => 0.1393796, 'age_non_hdl' => -0.0463501, 'age_hdl' => 0.0205926, 'age_sbp' => -0.1037717, 'age_dm' => -0.1737697, 'age_smoke' => -0.0915839, 'age_egfr' => -0.1637039, 'hba1c_dm' => 0.13159, 'hba1c_no_dm' => 0.1295185, 'intercept' => -3.040901],
                'ascvd' => ['age' => 0.7064146, 'non_hdl' => 0.1532267, 'hdl' => -0.1082166, 'sbp_min' => -0.2675288, 'sbp_max' => 0.3173809, 'dm' => 0.432604, 'smoke' => 0.3958842, 'egfr_min' => 0.3665014, 'egfr_max' => 0.0250243, 'bp_meds' => 0.2061158, 'statin' => -0.0899988, 'tx_sbp' => -0.0334959, 'tx_non_hdl' => 0.1034168, 'age_non_hdl' => -0.0255406, 'age_hdl' => 0.0247538, 'age_sbp' => -0.0917441, 'age_dm' => -0.1499195, 'age_smoke' => -0.098089, 'age_egfr' => -0.1305231, 'hba1c_dm' => 0.1157161, 'hba1c_no_dm' => 0.1288303, 'intercept' => -3.51835],
                'hf' => ['age' => 0.911787, 'sbp_min' => -0.6568071, 'sbp_max' => 0.3524645, 'dm' => 0.5849752, 'smoke' => 0.5014014, 'bmi_min' => -0.0512352, 'bmi_max' => 0.365294, 'egfr_min' => 0.6892219, 'egfr_max' => 0.0292377, 'bp_meds' => 0.3038296, 'tx_sbp' => -0.0515032, 'age_sbp' => -0.1262343, 'age_dm' => -0.2449514, 'age_smoke' => -0.1392217, 'age_bmi' => 0.0009592, 'age_egfr' => -0.1917105, 'hba1c_dm' => 0.1652857, 'hba1c_no_dm' => 0.1505859, 'intercept' => -3.961954]
            ]
        ],
        'full' => [ // Table S12E
            'female' => [
                'cvd' => ['age' => 0.7716794, 'non_hdl' => 0.0062109, 'hdl' => -0.1547756, 'sbp_min' => -0.1933123, 'sbp_max' => 0.3071217, 'dm' => 0.496753, 'smoke' => 0.466605, 'egfr_min' => 0.4780697, 'egfr_max' => 0.0529077, 'bp_meds' => 0.3034892, 'statin' => -0.1556524, 'tx_sbp' => -0.0667026, 'tx_non_hdl' => 0.1061825, 'age_non_hdl' => -0.0742271, 'age_hdl' => 0.0288245, 'age_sbp' => -0.0875188, 'age_dm' => -0.2267102, 'age_smoke' => -0.0676125, 'age_egfr' => -0.1493231, 'uacr' => 0.1645922, 'hba1c_dm' => 0.1298513, 'hba1c_no_dm' => 0.1412555, 'sdi_missing' => 0.1804508, 'intercept' => -3.860385],
                'ascvd' => ['age' => 0.7023067, 'non_hdl' => 0.0898765, 'hdl' => -0.1407316, 'sbp_min' => -0.0256648, 'sbp_max' => 0.314511, 'dm' => 0.4799217, 'smoke' => 0.4062049, 'egfr_min' => 0.3847744, 'egfr_max' => 0.0495174, 'bp_meds' => 0.2133861, 'statin' => -0.0678552, 'tx_sbp' => -0.0451416, 'tx_non_hdl' => 0.0788187, 'age_non_hdl' => -0.0535985, 'age_hdl' => 0.0291762, 'age_sbp' => -0.0961839, 'age_dm' => -0.2001466, 'age_smoke' => -0.0586472, 'age_egfr' => -0.1537791, 'uacr' => 0.1371824, 'hba1c_dm' => 0.123192, 'hba1c_no_dm' => 0.1410572, 'sdi_missing' => 0.1588908, 'intercept' => -4.291503],
                'hf' => ['age' => 0.884209, 'sbp_min' => -0.421474, 'sbp_max' => 0.3002919, 'dm' => 0.6170359, 'smoke' => 0.5380269, 'bmi_min' => -0.0191335, 'bmi_max' => 0.2764302, 'egfr_min' => 0.5975847, 'egfr_max' => 0.0654197, 'bp_meds' => 0.3313614, 'tx_sbp' => -0.1002304, 'age_sbp' => -0.0845363, 'age_dm' => -0.2989062, 'age_smoke' => -0.1111354, 'age_bmi' => 0.0008104, 'age_egfr' => -0.1666635, 'uacr' => 0.1948135, 'hba1c_dm' => 0.176668, 'hba1c_no_dm' => 0.1614911, 'sdi_missing' => 0.1819138, 'intercept' => -4.896524]
            ],
            'male' => [
                'cvd' => ['age' => 0.7847578, 'non_hdl' => 0.0534485, 'hdl' => -0.0911282, 'sbp_min' => -0.4921973, 'sbp_max' => 0.2972415, 'dm' => 0.4527054, 'smoke' => 0.3726641, 'egfr_min' => 0.3886854, 'egfr_max' => 0.0081661, 'bp_meds' => 0.2508052, 'statin' => -0.1538484, 'tx_sbp' => -0.0474695, 'tx_non_hdl' => 0.1415382, 'age_non_hdl' => -0.0436455, 'age_hdl' => 0.0199549, 'age_sbp' => -0.1022686, 'age_dm' => -0.1762507, 'age_smoke' => -0.0715873, 'age_egfr' => -0.1428668, 'uacr' => 0.1772853, 'hba1c_dm' => 0.1165698, 'hba1c_no_dm' => 0.1048297, 'sdi_missing' => 0.144759, 'intercept' => -3.631387],
                'ascvd' => ['age' => 0.7128741, 'non_hdl' => 0.1465201, 'hdl' => -0.1125794, 'sbp_min' => -0.3387216, 'sbp_max' => 0.2980252, 'dm' => 0.399583, 'smoke' => 0.3379111, 'egfr_min' => 0.2582604, 'egfr_max' => 0.0147769, 'bp_meds' => 0.1686621, 'statin' => -0.1073619, 'tx_sbp' => -0.0381038, 'tx_non_hdl' => 0.1034169, 'age_non_hdl' => -0.0228755, 'age_hdl' => 0.0267453, 'age_sbp' => -0.0897449, 'age_dm' => -0.1497464, 'age_smoke' => -0.077206, 'age_egfr' => -0.1198368, 'uacr' => 0.1375837, 'hba1c_dm' => 0.101282, 'hba1c_no_dm' => 0.1092726, 'sdi_missing' => 0.1388492, 'intercept' => -3.969788],
                'hf' => ['age' => 0.9095703, 'sbp_min' => -0.6765184, 'sbp_max' => 0.3111651, 'dm' => 0.5535052, 'smoke' => 0.4326811, 'bmi_min' => -0.0854286, 'bmi_max' => 0.3551736, 'egfr_min' => 0.5102245, 'egfr_max' => 0.015472, 'bp_meds' => 0.2570964, 'tx_sbp' => -0.0591177, 'age_sbp' => -0.1154332, 'age_dm' => -0.2437577, 'age_smoke' => -0.105363, 'age_bmi' => 0.0037907, 'age_egfr' => -0.1660207, 'uacr' => 0.2164607, 'hba1c_dm' => 0.148297, 'hba1c_no_dm' => 0.1234088, 'sdi_missing' => 0.1694628, 'intercept' => -4.663513]
            ]
        ]
    ];

    public function calculate(array $data): array
    {
        $g = $data['gender'];
        $dm = (int)$data['diabetes'];
        $smoke = (int)$data['smoker'];
        $bpMeds = (int)$data['bpMeds'];
        $statin = (int)$data['statin'];

        $hba1c = isset($data['hba1c']) && is_numeric($data['hba1c']) ? (float)$data['hba1c'] : null;
        $uacr = isset($data['uacr']) && is_numeric($data['uacr']) ? (float)$data['uacr'] : null;

        // Select the exact model based on available variables (Router)
        if ($hba1c !== null && $uacr !== null) {
            $coeffs = $this->models['full'][$g];
        } elseif ($uacr !== null) {
            $coeffs = $this->models['acr'][$g];
        } elseif ($hba1c !== null) {
            $coeffs = $this->models['a1c'][$g];
        } else {
            $coeffs = $this->models['base'][$g];
        }

        // Standardization (Centering)
        $age_c = ($data['age'] - 55) / 10;
        $non_hdl_c = (($data['tc'] - $data['hdl']) * 0.02586) - 3.5;
        $hdl_c = ($data['hdl'] * 0.02586 - 1.3) / 0.3;
        $sbp_min_c = (min($data['sbp'], 110) - 110) / 20;
        $sbp_max_c = (max($data['sbp'], 110) - 130) / 20;
        $egfr_min_c = (min($data['egfr'], 60) - 60) / -15;
        $egfr_max_c = (max($data['egfr'], 60) - 90) / -15;
        $bmi_min_c = (min($data['bmi'], 30) - 25) / 5;
        $bmi_max_c = (max($data['bmi'], 30) - 30) / 5;

        $results = [];
        foreach (['cvd', 'ascvd', 'hf'] as $out) {
            $c = $coeffs[$out];

            // 1. Main body of logistic regression
            $lo = $c['intercept']
                + ($c['age'] ?? 0) * $age_c
                + ($c['non_hdl'] ?? 0) * $non_hdl_c
                + ($c['hdl'] ?? 0) * $hdl_c
                + ($c['sbp_min'] ?? 0) * $sbp_min_c
                + ($c['sbp_max'] ?? 0) * $sbp_max_c
                + ($c['dm'] ?? 0) * $dm
                + ($c['smoke'] ?? 0) * $smoke
                + ($c['bmi_min'] ?? 0) * $bmi_min_c
                + ($c['bmi_max'] ?? 0) * $bmi_max_c
                + ($c['egfr_min'] ?? 0) * $egfr_min_c
                + ($c['egfr_max'] ?? 0) * $egfr_max_c
                + ($c['bp_meds'] ?? 0) * $bpMeds
                + ($c['statin'] ?? 0) * $statin;

            // 2. Apply interactive terms (Interactions)
            $lo += ($c['tx_sbp'] ?? 0) * ($bpMeds * $sbp_max_c);
            $lo += ($c['tx_non_hdl'] ?? 0) * ($statin * $non_hdl_c);
            $lo += ($c['age_non_hdl'] ?? 0) * ($age_c * $non_hdl_c);
            $lo += ($c['age_hdl'] ?? 0) * ($age_c * $hdl_c);
            $lo += ($c['age_sbp'] ?? 0) * ($age_c * $sbp_max_c);
            $lo += ($c['age_dm'] ?? 0) * ($age_c * $dm);
            $lo += ($c['age_smoke'] ?? 0) * ($age_c * $smoke);
            $lo += ($c['age_bmi'] ?? 0) * ($age_c * $bmi_max_c);
            $lo += ($c['age_egfr'] ?? 0) * ($age_c * $egfr_min_c);

            // 3. Apply blood sugar (HbA1c centered at 5.3)
            if ($hba1c !== null) {
                $h_c = $hba1c - 5.3;
                $lo += ($dm === 1) ? ($c['hba1c_dm'] ?? 0) * $h_c : ($c['hba1c_no_dm'] ?? 0) * $h_c;
            }

            // 4. Apply protein excretion (Absolute ln-ACR)
            if ($uacr !== null) {
                $lo += ($c['uacr'] ?? 0) * log(max($uacr, 0.1));
            }

            // 5. Apply SDI Missing penalty to match the AHA website
            if (isset($c['sdi_missing'])) {
                $lo += $c['sdi_missing'];
            }

            $p = exp($lo) / (1 + exp($lo));
            $results[$out] = round($p * 100, 1);
        }

        return $results;
    }
}
