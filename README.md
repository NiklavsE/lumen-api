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
        "account_balance": 980,
        "address": "87752 Walter Drive\nLinnietown, KY 18660",
        "city": "Kleinberg",
        "email": "wfeest@example.net",
        "first_name": "John",
        "last_name": "Brown",
        "salutation": "mr",
        "social_security_num": "827-52-2052"
      }
    ],
    "meta": {
      "pagination": {
        "count": 1,
        "current_page": 1,
        "links": [],
        "per_page": 10,
        "total": 1,
        "total_pages": 1
      }
    }
  }
```
## CSV Import
CSV import is implemented using php artisan command:
```
php artisan import:csv-data
```
Command reads all csv files from storage/customer_data folder and imports content into database.
Folder contains inital dummy file with column names, that are expected to be imported.

## Tests
Tests are stored in tests folder.



