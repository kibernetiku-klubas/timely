<div>
    <div class="alert-container">
        <div class="flex justify-center text-black bg-white px-4 py-3 rounded-lg shadow-xl relative max-w-lg mx-auto mt-6 p-6">
            <strong class="font-bold">{{ session()->get('success') }}</strong>
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
