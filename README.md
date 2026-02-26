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
You can easily integrate this class into the controllers of frameworks like **Laravel** (or Serverless functions) to handle `POST` requests.

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

## 💻 PHP / Laravel Implementation Example
To use this calculation service in your projects, simply instantiate the class and pass the decoded JSON data to the `calculate` method:

```php
use App\Services\PreventCalculatorApi;

// Receiving data from the request (in Laravel: $request->all())
$patientData = json_decode($requestPayload, true);

$calculator = new PreventCalculatorApi();
$risks = $calculator->calculate($patientData);

return response()->json([
    'status' => 'success',
    'data' => $risks
]);
```
