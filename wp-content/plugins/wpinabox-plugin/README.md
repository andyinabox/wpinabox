WPinabox Plugin
============
This contains most of the wpinabox site's information architecture, as well as some database maintenance tools.

Database Tools
--------------------

### Migrations

For updating the db based for the new site. Uses [Phinx](https://github.com/robmorgan/phinx). Use the `migrate_db.sh` script to initialize the project from old database (but **not** to run additional migrations once set up).

```
./bin/migrate_db.sh
```

### Fixtures

For generating content. Uses the [Faker](https://github.com/trendwerk/faker) plugin for WP-CLI.