# Setting up this project locally

Make sure that your system has [PHP](https://www.php.net/manual/en/install.php), [Composer](https://getcomposer.org/) and [node with npm](https://nodejs.org/en).

- Clone the repository
  ```
  git clone https://github.com/kibernetiku-klubas/timely.git
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
- npm run
  ```
  npm run dev
  ```
- Start project
  ```
  php artisan serve
  ```
- Go to ip shown in terminal
- Start building
