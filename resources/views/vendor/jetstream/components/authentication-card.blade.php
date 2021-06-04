<div class="min-h-screen flex flex-col pt-6 sm:pt-0 bg-gray-100">
    <a href="" class="-intro-x flex items-center pt-5">
        <div class="guest-layout-logo-box">
            {{ $logo }}
        </div>
    </a>
    <div class="my-auto">
        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
            <h2 class="guest-layout-intro-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
        </div>
        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500">
            <span class="guest-layout-intro-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
        </div>
    </div>

    <div class="flex items-center sm:justify-center">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden">
            {{ $slot }}
        </div>
    </div>
</div>
