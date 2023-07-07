# env files

Since many of Laravel's configuration option values may vary depending on whether your application is running on your local machine or on a production web server, many important configuration values are defined using the .env file that exists at the root of your application.

Your .env file should not be committed to your application's source control, since each developer / server using your application could require a different environment configuration. Furthermore, this would be a security risk in the event an intruder gains access to your source control repository, since any sensitive credentials would get exposed.
Laravel's default .env file contains some common configuration values that may differ based on whether your application is running locally or on a production web server. These values are then retrieved from various Laravel configuration files within the config directory using Laravel's env function.

If you are developing with a team, you may wish to continue including a .env.example file with your application. By putting placeholder values in the example configuration file, other developers on your team can clearly see which environment variables are needed to run your application.

This project's .env.example is currently configured for debug mode with sqlite database

To use .env.example just copy it to your local .env file. Feel free to modify it to your preferences and needs.
  ```
  cp .env.example .env
  ```

Laravel's documentation on configuration [here](https://laravel.com/docs/10.x/configuration#environment-configuration)
