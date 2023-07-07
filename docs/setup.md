# Setting up this project locally

Make sure that your system has [PHP](https://www.php.net/manual/en/install.php) and [Composer](https://getcomposer.org/).
For local development we will be using sqlite database. More about this project database [here](database.md)

- Clone the repository
  ```
  git clone https://github.com/kibernetiniu-gudruoliu-bendruomene/first-project.git
  ```
- cd to project dir
  ```
  cd first-project
  ```
- Install Composer Dependencies
  ```
  composer install
  ```
- Install NPM Dependencies
  ```
  npm install
  ```
- Create a copy of your .env file. More on .env files [here](env.md)
  ```
  cp .env.example .env
  ```
- Generate an app encryption key
  ```
  php artisan key:generate
  ```
- cd to database folder
  ```
  cd database
  ```
- Crete a sqlite database
  ```
  touch database.sqlite
  ```
- cd back
  ```
  cd ..
  ```
- Migrate the database
  ```
  php artisan migrate
  ```
- npm (Which to choose? If you want to develop use npm run dev (this gives auto-reload on save). For production use npm run production, to build use npm run build)
  ```
  npm run build or npm run dev or npm run production
  ```
- Start project
  ```
  php artisan serve
  ```
- Go to ip shown in terminal
- Start building
