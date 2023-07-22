I created the MRC:
`php artisan make:model -mrc Meeting`

I added the necessary things (for the UUID) to the Meeting model. Basically, there we override the default Model actions and describe how new UUIDs are generated (my understanding, at least)

I've arranged for a new table `meetings` to be created in migration with this info:
- `id` (string; unique)
- `owner_id` (user ID of the owner of the meet; I took the code from laravel bootcamp; when the user account is deleted, the meet will be deleted too)
- `title` (string; meet name)
- `description` (string; default: "Just another meeting"; meeting description)
- `location` (string; default: "Not specified"; meeting location)
- `timezone` (smallInteger; default: 0; time zone of the meeting; use as offset. e.g. `timezone=3` => UTC+3)
- `duration` (smallInteger; default: 30; duration of the meeting; we use the unit minutes, I think the most flexible will be as follows)
- `meet_times` (string; default: "{}"; all stored selectable times; we will store in JSON format. we will store both dates and times)
- `timestamps` (created_at, updated_at; default ones)
- `delete_after` (integer; default: 90; how many days after creation let the meet be undeleted. long term this is really useful and necessary, so I added it; -1 means we never delete, perhaps?)
