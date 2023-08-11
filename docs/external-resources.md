# Resources for learning

## Best resource 
[Official laravel docs](https://laravel.com/docs/10.x).

## For learning by doing:
[Laravel bootcamp](https://bootcamp.laravel.com/).
This project uses blade, so select build chirper with blade.

## Good videos for learning:

- Good video, but 4 hours long [here](https://youtu.be/MYyJ4PuL4pY).
- Shorter video that goes over the basics [here](https://youtu.be/AEVhR-hD2Wk).
- 3 minute concept overview [here](https://youtu.be/dQw4w9WgXcQ).

# PHP
 [PHP documentation](https://www.php.net/manual/en/)

# Tailwind

 [Tailwindcss documentation](https://tailwindcss.com/docs/utility-first)

Tailwind allows writing css directly to html as a class.

For example:
```
<div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-lg flex items-center space-x-4">
  <div class="shrink-0">
    <img class="h-12 w-12" src="/img/logo.svg" alt="ChitChat Logo">
  </div>
  <div>
    <div class="text-xl font-medium text-black">ChitChat</div>
    <p class="text-slate-500">You have a new message!</p>
  </div>
</div>
```
Instead of this:
```
<div class="chat-notification">
  <div class="chat-notification-logo-wrapper">
    <img class="chat-notification-logo" src="/img/logo.svg" alt="ChitChat Logo">
  </div>
  <div class="chat-notification-content">
    <h4 class="chat-notification-title">ChitChat</h4>
    <p class="chat-notification-message">You have a new message!</p>
  </div>
</div>

<style>
  .chat-notification {
    display: flex;
    max-width: 24rem;
    margin: 0 auto;
    padding: 1.5rem;
    border-radius: 0.5rem;
    background-color: #fff;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  }
  .chat-notification-logo-wrapper {
    flex-shrink: 0;
  }
  .chat-notification-logo {
    height: 3rem;
    width: 3rem;
  }
  .chat-notification-content {
    margin-left: 1.5rem;
    padding-top: 0.25rem;
  }
  .chat-notification-title {
    color: #1a202c;
    font-size: 1.25rem;
    line-height: 1.25;
  }
  .chat-notification-message {
    color: #718096;
    font-size: 1rem;
    line-height: 1.5;
  }
</style>
```

# DaisyUI

DaisyUi [documentation](https://daisyui.com/components/)

DaisyUI is a tailwind component library that is being used in this project.

Instead of writing a bunch of css code
```
<button
  class="inline-block cursor-pointer rounded-md bg-gray-800 px-4 py-3 text-center text-sm font-semibold uppercase text-white transition duration-200 ease-in-out hover:bg-gray-900">
  Button
</button>
```

We can just use a DaisyUI component
```
<button class="btn">Button</button>
```

# PHPUnit 
[PHPUnit documentation](https://docs.phpunit.de/en/10.2/)
