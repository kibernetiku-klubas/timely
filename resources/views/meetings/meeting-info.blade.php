<div class="bg-white p-4">
    <div class="text-3xl font-bold text-black uppercase mb-4">{{ $meeting->title }}</div>
    <div class="text-lg font-bold text-black uppercase mb-4">Meeting created by {{$creator->name}}</div>

    <div class="flex items-center mb-4">
        <svg fill="#000000" height="30" width="30" viewBox="0 0 512 512" class="mr-3 ml-1">
            <path d="M0,462h256v-64H0V462z M0,355.3h512v-64H0V355.3z M256,184.7H0v64h256V184.7z M0,78v64h512V78H0z"/>
        </svg>
        <div>{{ $meeting->description }}</div>
    </div>

    <div class="flex items-center mb-4">
        <svg width="25" height="25" viewBox="0 0 64 64" class="mr-2">
            <path fill="#000000" d="M32,0C18.746,0,8,10.746,8,24c0,5.219,1.711,10.008,4.555,13.93c0.051,0.094,0.059,0.199,0.117,0.289l16,24
            C29.414,63.332,30.664,64,32,64s2.586-0.668,3.328-1.781l16-24c0.059-0.09,0.066-0.195,0.117-0.289C54.289,34.008,56,29.219,56,24
            C56,10.746,45.254,0,32,0z M32,32c-4.418,0-8-3.582-8-8s3.582-8,8-8s8,3.582,8,8S36.418,32,32,32z"/>
        </svg>
        <div>{{ $meeting->location }}</div>
    </div>

    <div class="flex items-center mb-4">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
            <path
                d="M12 7V12L14.5 13.5M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div>{{ $meeting->duration }} minutes</div>
    </div>

    <div class="font-bold pr-2 uppercase flex justify-center">Link to meeting:</div>
    <div class="flex justify-center items-center mb-6">
        <div class="tooltip mb-2" data-tip="Press the icon on the right to copy">
            <a class="link" id="link">http://127.0.0.1:8000/meetings/{{ $meeting->id }}</a>
        </div>
        <a id="copyLink" class="btn-ghost rounded-lg">
            <svg width="30" height="30" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="copy" fill="#000000" transform="translate(85.333333, 42.666667)">
                        <path
                            d="M341.333333,85.3333333 L341.333333,405.333333 L85.3333333,405.333333 L85.3333333,85.3333333 L341.333333,85.3333333 Z M298.666667,128 L128,128 L128,362.666667 L298.666667,362.666667 L298.666667,128 Z M234.666667,7.10542736e-15 L234.666667,42.6666667 L42.6666667,42.6666667 L42.6666667,298.666667 L1.42108547e-14,298.666667 L1.42108547e-14,7.10542736e-15 L234.666667,7.10542736e-15 Z">
                        </path>
                    </g>
                </g>
            </svg>
        </a>
    </div>
</div>

<script>
    document.getElementById("copyLink").addEventListener("click", function () {
        navigator.clipboard.writeText('http://127.0.0.1:8000/meetings/{{ $meeting->id }}')
            .then(() => console.log('Text copied to clipboard'))
            .catch(err => console.log('Failed to copy text: ', err));
        let linkElement = document.getElementById("link");
        linkElement.innerText = "Link copied!";
        setTimeout(function () {
            linkElement.innerText = "http://127.0.0.1:8000/meetings/{{ $meeting->id }}";
        }, 2250);
    });
</script>
