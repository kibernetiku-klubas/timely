# Docs for a branch feature/new-database-migration-for-meet-dates

Created Date.php model and added a BelongsTo relationship with meeting_id

In Meeting.php model added a return type of void to boot function.
Created has many relationship with Date model.

Created Factories for dates and meetings to generate fake data. To run use ```php artisan db:seed```

Added a call to factory from DatabaseSeeder.php

Created a migration for dates table with data:
1. id
2. foreignId from meetings table meeting_id
3. dateTime type date_and_time
4. string voted_by

Create phpunit feature test for meeting and dates relationships. First test to check if meeting dates can be retrieved and second to check if related dates are deleted on meeting deletion
To run tests use ```php artisan test``` or press run from PhpStorm
