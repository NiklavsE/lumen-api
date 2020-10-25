# Description

Application with CSV Aggregator that imports csv file contents from folder into database and API endpoint that returns items according to structure.
Built with Lumen.

## API
Api endpoint:
```
/api/v1/customers
```

Example response: 

```
{
  "data": [
    {
      "first_name": null,
      "last_name": "Doe",
      "email": "test+doe@gmail.com",
      "address": null,
      "city": "London",
      "salutation": "mr",
      "social_security_num": null,
      "account_balance": 50000
    },
    {
      "first_name": "Jane",
      "last_name": "Doe",
      "email": "test+jane@gmail.com",
      "address": null,
      "city": null,
      "salutation": "mr",
      "social_security_num": "555-111-222-000",
      "account_balance": 2000
    }
  ],
  "meta": {
    "pagination": {
      "total": 4,
      "count": 2,
      "per_page": 2,
      "current_page": 2,
      "total_pages": 2,
      "links": {
        "previous": "http://localhost:8000/api/v1/customers?page=1"
      }
    }
  }
}
```
## CSV Import
CSV import is implemented using php artisan command:
```
php artisan import:csv-data
```
Command reads all csv files from storage/customer_data folder and imports content into database

## Tests
Tests are stored in tests folder.



