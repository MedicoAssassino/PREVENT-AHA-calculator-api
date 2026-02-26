# 🫀 AHA 2023 PREVENT Risk Calculator API

🌍 *Read this in other languages: [فارسی (Persian)](README-fa.md)*

A **fast**, **structured**, and **standalone** API service based on **PHP** for calculating the 10-year risk of Cardiovascular Disease (CVD), Atherosclerotic Cardiovascular Disease (ASCVD), and Heart Failure (HF) using the **AHA 2023 PREVENT™ Equations**.

---

## 🩺 Clinical Significance & Background
The **PREVENT** (Predicting Risk of cardiovascular disease EVENTs) equations are a modern replacement for the older *Pooled Cohort Equations (PCE)*. 
These new equations utilize data from the latest multi-ethnic cohorts and have the capability to incorporate kidney function markers (`eGFR` and `uACR`) as well as metabolic markers (`HbA1c`) to increase prediction accuracy.

📚 *Source: Tables S12A to S12E from the American Heart Association (AHA) 2023 article supplement.*

---

## 🚀 API Usage Guide

This service is designed to receive patient clinical data via a `JSON` payload and return the calculated 10-year risk percentages after processing.

### 🎯 Endpoint Expectation
You can easily integrate this class into the controllers of PHPframeworks (or Serverless functions) to handle `POST` requests.

**📌 Required Headers:**
- `Content-Type: application/json`
- `Accept: application/json`

---

### 📥 Request Body
Here is a complete example of the patient clinical parameters that should be sent in JSON format:

```json
{
  "gender": "male",
  "age": 60,
  "tc": 200,
  "hdl": 45,
  "sbp": 140,
  "bmi": 28.5,
  "egfr": 75,
  "diabetes": 0,
  "smoker": 0,
  "bpMeds": 1,
  "statin": 1,
  "hba1c": 5.8,
  "uacr": 15
}
```

> 💡 **Important Note:** The `hba1c` and `uacr` parameters are **optional**. The system is designed so that if these values are not provided, it will automatically fall back to the Base Models for calculation.

---

### 📤 Response
After processing, the output is returned in this format:

```json
{
  "status": "success",
  "data": {
    "cvd": 12.4,
    "ascvd": 9.8,
    "hf": 3.5
  },
  "message": "Calculated successfully."
}
```

---

## 🧠 Routing Logic
The `calculate()` method in this service acts as a smart router, selecting the appropriate model based on the provided data:

* 🥇 **Full Model:** Used if both `hba1c` and `uacr` values are available.
* 🥈 **ACR Model:** Used if only the `uacr` value is provided.
* 🥉 **A1C Model:** Used if only the `hba1c` value is provided.
* 🏅 **Base Model:** Used if neither of these two optional parameters is provided.

---

## 📦 Installation via Composer

To integrate this service into your Laravel project, run the following command in your terminal:

```bash
composer require h.clean/prevent-calc-api
```

### ⚙️ Laravel Integration

This package features **Auto-Discovery**, meaning Laravel will automatically register the Service Provider and the `PreventCalc` Facade.

#### Using the Facade (Recommended)
You can call the calculator from anywhere in your application:

```php
use HClean\PreventCalcApi\Facades\PreventCalc;

$data = [
    "gender" => "female",
    "age" => 55,
    "tc" => 210,
    "hdl" => 55,
    "sbp" => 130,
    "bmi" => 26.0,
    "egfr" => 85,
    "diabetes" => 0,
    "smoker" => 0,
    "bpMeds" => 0,
    "statin" => 0
];

$results = PreventCalc::calculate($data);

// Output: ["cvd" => 4.2, "ascvd" => 3.1, "hf" => 1.2]
```

### 🛠 Manual Registration
If you are using an older version of Laravel (below 5.5) or have auto-discovery disabled, add the following to your `config/app.php`:

```php
'providers' => [
    HClean\PreventCalcApi\MyServiceProvider::class,
],

'aliases' => [
    'PreventCalc' => HClean\PreventCalcApi\Facades\PreventCalc::class,
],
```

