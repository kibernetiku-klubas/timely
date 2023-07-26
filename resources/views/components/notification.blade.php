<div>
    <div class="alert-container">
        <div class="flex justify-center {{ $type === 'success' ? 'text-green-600' : 'text-red-600' }} bg-white px-4 py-3 rounded-lg shadow-xl relative max-w-lg mx-auto mt-6 p-6">
            <strong class="font-bold">{{ $message }}</strong>
        </div>
    </div>

    <style>
        .alert-container {
            opacity: 1;
            transition: opacity 0.3s ease-out;
        }

        .alert-container.fade-out {
            opacity: 0;
        }
    </style>

    <script>
        setTimeout(function () {
            let alertContainer = document.querySelector('.alert-container');
            alertContainer.classList.add('fade-out');

            setTimeout(function () {
                alertContainer.style.display = 'none';
            }, 400);
        }, 2000);
    </script>
</div>
