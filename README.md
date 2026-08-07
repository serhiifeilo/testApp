# Company Versioning API

REST API for creating and updating companies with automatic versioning.

## Features

- Create a new company
- Update existing company
- Automatic versioning
- Duplicate request detection
- Validation using FormRequest
- Feature Tests
- Docker support

## Available Endpoints

POST /api/company

GET /api/company/{edrpou}/versions


## Tech Stack

- PHP 8.3
- Laravel 12
- MySQL 8
- Docker
- PHPUnit

---

## Project Structure

```
app
├── Actions
│   └── SaveCompanyAction.php
│
├── Contracts
│   └── Versionable.php
│
├── Http
│   ├── Controllers
│   └── Requests
│
├── Models
│   ├── Company.php
│   └── CompanyVersion.php
│
├── Services
│   └── VersioningService.php
│
└── Traits
    └── HasVersions.php
```