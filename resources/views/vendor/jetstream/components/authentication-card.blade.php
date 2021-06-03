<div class="min-h-screen flex flex-col pt-6 sm:pt-0 bg-gray-100 guest-layout">
    <div class="guest-layout-logo-box">
        {{ $logo }}
    </div>

    <div class="guest-layout-info-box">
        <div class="aligned-box">
            <h2 class="guest-layout-intro-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2>
            <span class="guest-layout-intro-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
        </div>
    </div>

    <div class="guest-layout-sign-in-box flex items-center sm:justify-center">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden">
            {{ $slot }}
        </div>
    </div>
</div>
