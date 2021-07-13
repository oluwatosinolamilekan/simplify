<x-app-layout :bodyClass="'main'">
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="mt-8">
        <x-tabs active="Dashboard">
            <x-tab name="Dashboard">
                <div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: Top Categories -->
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Top Categories
                            </h2>
                            <div class="dropdown ml-auto">
                                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"> <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i> </a>
                                <div class="dropdown-menu w-40">
                                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="plus" class="w-4 h-4 mr-2"></i> Add Category </a>
                                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="settings" class="w-4 h-4 mr-2"></i> Settings </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="flex flex-col sm:flex-row">
                                <div class="mr-auto">
                                    <a href="" class="font-medium">Wordpress Template</a>
                                    <div class="text-gray-600 mt-1">HTML, PHP, Mysql</div>
                                </div>
                                <div class="flex">
                                    <div class="w-32 -ml-2 sm:ml-0 mt-5 mr-auto sm:mr-5">
                                        <canvas class="simple-line-chart-1" data-random="true" height="50"></canvas>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-medium">6.5k</div>
                                        <div class="bg-theme-18 text-theme-9 rounded px-2 mt-1.5">+150</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row mt-5">
                                <div class="mr-auto">
                                    <a href="" class="font-medium">Bootstrap HTML Template</a>
                                    <div class="text-gray-600 mt-1">HTML, PHP, Mysql</div>
                                </div>
                                <div class="flex">
                                    <div class="w-32 -ml-2 sm:ml-0 mt-5 mr-auto sm:mr-5">
                                        <canvas class="simple-line-chart-1" data-random="true" height="50"></canvas>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-medium">2.5k</div>
                                        <div class="bg-theme-17 text-theme-11 rounded px-2 mt-1.5">+150</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row mt-5">
                                <div class="mr-auto">
                                    <a href="" class="font-medium">Tailwind HTML Template</a>
                                    <div class="text-gray-600 mt-1">HTML, PHP, Mysql</div>
                                </div>
                                <div class="flex">
                                    <div class="w-32 -ml-2 sm:ml-0 mt-5 mr-auto sm:mr-5">
                                        <canvas class="simple-line-chart-1" data-random="true" height="50"></canvas>
                                    </div>
                                    <div class="text-center">
                                        <div class="font-medium">3.4k</div>
                                        <div class="bg-theme-14 text-theme-10 rounded px-2 mt-1.5">+150</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Top Categories -->
                    <!-- BEGIN: Work In Progress -->
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div class="flex items-center px-5 py-5 sm:py-0 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Work In Progress
                            </h2>
                            <div class="dropdown ml-auto sm:hidden">
                                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"> <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i> </a>
                                <div class="nav nav-tabs dropdown-menu w-40" role="tablist">
                                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2"> <a id="work-in-progress-new-tab" href="javascript:;" data-toggle="tab" data-target="#work-in-progress-new" class="block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md" role="tab" aria-controls="work-in-progress-new" aria-selected="true">New</a> <a id="work-in-progress-last-week-tab" href="javascript:;" data-toggle="tab" data-target="#work-in-progress-last-week" class="block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md" role="tab" aria-selected="false">Last Week</a> </div>
                                </div>
                            </div>
                            <div class="nav nav-tabs ml-auto hidden sm:flex" role="tablist"> <a id="work-in-progress-mobile-new-tab" data-toggle="tab" data-target="#work-in-progress-new" href="javascript:;" class="py-5 ml-6 active" role="tab" aria-selected="true">New</a> <a id="week-work-in-progress-mobile-last-week-tab" data-toggle="tab" data-target="#work-in-progress-last-week" href="javascript:;" class="py-5 ml-6" role="tab" aria-selected="false">Last Week</a> </div>
                        </div>
                        <div class="p-5">
                            <div class="tab-content">
                                <div id="work-in-progress-new" class="tab-pane active" role="tabpanel" aria-labelledby="work-in-progress-new-tab">
                                    <div>
                                        <div class="flex">
                                            <div class="mr-auto">Pending Tasks</div>
                                            <div>20%</div>
                                        </div>
                                        <div class="progress h-1 mt-2">
                                            <div class="progress-bar w-1/2 bg-theme-1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <div class="flex">
                                            <div class="mr-auto">Completed Tasks</div>
                                            <div>2 / 20</div>
                                        </div>
                                        <div class="progress h-1 mt-2">
                                            <div class="progress-bar w-1/4 bg-theme-1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <div class="flex">
                                            <div class="mr-auto">Tasks In Progress</div>
                                            <div>42</div>
                                        </div>
                                        <div class="progress h-1 mt-2">
                                            <div class="progress-bar w-3/4 bg-theme-1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <a href="" class="btn btn-secondary block w-40 mx-auto mt-5">View More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Work In Progress -->
                </div>
            </x-tab>

            <x-tab name="Account & Profile">
                <div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: Daily Sales -->
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Daily Sales
                            </h2>
                            <div class="dropdown ml-auto sm:hidden">
                                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"> <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i> </a>
                                <div class="dropdown-menu w-40">
                                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                        <a href="javascript:;" class="flex items-center p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Excel </a>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-secondary hidden sm:flex"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Excel </button>
                        </div>
                        <div class="p-5">
                            <div class="relative flex items-center">
                                <div class="w-12 h-12 flex-none image-fit">
                                    <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-15.jpg">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <a href="" class="font-medium">Russell Crowe</a>
                                    <div class="text-gray-600 mr-5 sm:mr-5">Bootstrap 4 HTML Admin Template</div>
                                </div>
                                <div class="font-medium text-gray-700 dark:text-gray-600">+$19</div>
                            </div>
                            <div class="relative flex items-center mt-5">
                                <div class="w-12 h-12 flex-none image-fit">
                                    <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-7.jpg">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <a href="" class="font-medium">Tom Hanks</a>
                                    <div class="text-gray-600 mr-5 sm:mr-5">Tailwind HTML Admin Template</div>
                                </div>
                                <div class="font-medium text-gray-700 dark:text-gray-600">+$25</div>
                            </div>
                            <div class="relative flex items-center mt-5">
                                <div class="w-12 h-12 flex-none image-fit">
                                    <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-5.jpg">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <a href="" class="font-medium">Russell Crowe</a>
                                    <div class="text-gray-600 mr-5 sm:mr-5">Vuejs HTML Admin Template</div>
                                </div>
                                <div class="font-medium text-gray-700 dark:text-gray-600">+$21</div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Daily Sales -->
                    <!-- BEGIN: Latest Tasks -->
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div class="flex items-center px-5 py-5 sm:py-0 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Latest Tasks
                            </h2>
                            <div class="dropdown ml-auto sm:hidden">
                                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"> <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i> </a>
                                <div class="nav nav-tabs dropdown-menu w-40" role="tablist">
                                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2"> <a id="latest-tasks-new-tab" href="javascript:;" data-toggle="tab" data-target="#latest-tasks-new" class="block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md" role="tab" aria-controls="latest-tasks-new" aria-selected="true">New</a> <a id="latest-tasks-last-week-tab" href="javascript:;" data-toggle="tab" data-target="#latest-tasks-last-week" class="block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md" role="tab" aria-selected="false">Last Week</a> </div>
                                </div>
                            </div>
                            <div class="nav nav-tabs ml-auto hidden sm:flex" role="tablist"> <a id="latest-tasks-mobile-new-tab" data-toggle="tab" data-target="#latest-tasks-new" href="javascript:;" class="py-5 ml-6 active" role="tab" aria-selected="true">New</a> <a id="latest-tasks-mobile-last-week-tab" data-toggle="tab" data-target="#latest-tasks-last-week" href="javascript:;" class="py-5 ml-6" role="tab" aria-selected="false">Last Week</a> </div>
                        </div>
                        <div class="p-5">
                            <div class="tab-content">
                                <div id="latest-tasks-new" class="tab-pane active" role="tabpanel" aria-labelledby="latest-tasks-new-tab">
                                    <div class="flex items-center">
                                        <div class="border-l-2 border-theme-1 dark:border-theme-1 pl-4">
                                            <a href="" class="font-medium">Create New Campaign</a>
                                            <div class="text-gray-600">10:00 AM</div>
                                        </div>
                                        <input class="form-check-switch ml-auto" type="checkbox">
                                    </div>
                                    <div class="flex items-center mt-5">
                                        <div class="border-l-2 border-theme-1 dark:border-theme-1 pl-4">
                                            <a href="" class="font-medium">Meeting With Client</a>
                                            <div class="text-gray-600">02:00 PM</div>
                                        </div>
                                        <input class="form-check-switch ml-auto" type="checkbox">
                                    </div>
                                    <div class="flex items-center mt-5">
                                        <div class="border-l-2 border-theme-1 dark:border-theme-1 pl-4">
                                            <a href="" class="font-medium">Create New Repository</a>
                                            <div class="text-gray-600">04:00 PM</div>
                                        </div>
                                        <input class="form-check-switch ml-auto" type="checkbox">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Latest Tasks -->
                </div>
            </x-tab>

            <x-tab name="Activities">
                <div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: Work In Progress -->
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div class="flex items-center px-5 py-5 sm:py-0 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Work In Progress
                            </h2>
                            <div class="dropdown ml-auto sm:hidden">
                                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"> <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i> </a>
                                <div class="nav nav-tabs dropdown-menu w-40" role="tablist">
                                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2"> <a id="work-in-progress-new-tab" href="javascript:;" data-toggle="tab" data-target="#work-in-progress-new" class="block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md" role="tab" aria-controls="work-in-progress-new" aria-selected="true">New</a> <a id="work-in-progress-last-week-tab" href="javascript:;" data-toggle="tab" data-target="#work-in-progress-last-week" class="block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md" role="tab" aria-selected="false">Last Week</a> </div>
                                </div>
                            </div>
                            <div class="nav nav-tabs ml-auto hidden sm:flex" role="tablist"> <a id="work-in-progress-mobile-new-tab" data-toggle="tab" data-target="#work-in-progress-new" href="javascript:;" class="py-5 ml-6 active" role="tab" aria-selected="true">New</a> <a id="week-work-in-progress-mobile-last-week-tab" data-toggle="tab" data-target="#work-in-progress-last-week" href="javascript:;" class="py-5 ml-6" role="tab" aria-selected="false">Last Week</a> </div>
                        </div>
                        <div class="p-5">
                            <div class="tab-content">
                                <div id="work-in-progress-new" class="tab-pane active" role="tabpanel" aria-labelledby="work-in-progress-new-tab">
                                    <div>
                                        <div class="flex">
                                            <div class="mr-auto">Pending Tasks</div>
                                            <div>20%</div>
                                        </div>
                                        <div class="progress h-1 mt-2">
                                            <div class="progress-bar w-1/2 bg-theme-1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <div class="flex">
                                            <div class="mr-auto">Completed Tasks</div>
                                            <div>2 / 20</div>
                                        </div>
                                        <div class="progress h-1 mt-2">
                                            <div class="progress-bar w-1/4 bg-theme-1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <div class="flex">
                                            <div class="mr-auto">Tasks In Progress</div>
                                            <div>42</div>
                                        </div>
                                        <div class="progress h-1 mt-2">
                                            <div class="progress-bar w-3/4 bg-theme-1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <a href="" class="btn btn-secondary block w-40 mx-auto mt-5">View More Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Work In Progress -->
                </div>
            </x-tab>
            <x-tab name="Tasks">
                <div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: General Statistic -->
                    <div class="intro-y box col-span-12">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                General Statistics
                            </h2>
                            <div class="dropdown ml-auto sm:hidden">
                                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false"> <i data-feather="more-horizontal" class="w-5 h-5 text-gray-600 dark:text-gray-300"></i> </a>
                                <div class="dropdown-menu w-40">
                                    <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                        <a href="javascript:;" class="flex items-center p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Download XML </a>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-secondary hidden sm:flex"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Download XML </button>
                        </div>
                        <div class="grid grid-cols-1 xxl:grid-cols-7 gap-6 p-5">
                            <div class="xxl:col-span-2">
                                <div class="grid grid-cols-2 gap-6">
                                    <div class="col-span-2 sm:col-span-1 xxl:col-span-2 box dark:bg-dark-5 p-5">
                                        <div class="font-medium">Net Worth</div>
                                        <div class="flex items-center mt-1 sm:mt-0">
                                            <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-theme-9">+23%</span> </div>
                                            <div class="w-5/6 overflow-auto">
                                                <canvas class="simple-line-chart-1" data-random="true" height="60"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1 xxl:col-span-2 box dark:bg-dark-5 p-5">
                                        <div class="font-medium">Sales</div>
                                        <div class="flex items-center mt-1 sm:mt-0">
                                            <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-theme-6">-5%</span> </div>
                                            <div class="w-5/6 overflow-aut4o">
                                                <canvas class="simple-line-chart-1" data-random="true" height="60"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1 xxl:col-span-2 box dark:bg-dark-5 p-5">
                                        <div class="font-medium">Profit</div>
                                        <div class="flex items-center mt-1 sm:mt-0">
                                            <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-theme-6">-10%</span> </div>
                                            <div class="w-5/6 overflow-auto">
                                                <canvas class="simple-line-chart-1" data-random="true" height="60"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2 sm:col-span-1 xxl:col-span-2 box dark:bg-dark-5 p-5">
                                        <div class="font-medium">Products</div>
                                        <div class="flex items-center mt-1 sm:mt-0">
                                            <div class="mr-4 w-20 flex"> USP: <span class="ml-3 font-medium text-theme-9">+55%</span> </div>
                                            <div class="w-5/6 overflow-auto">
                                                <canvas class="simple-line-chart-1" data-random="true" height="60"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="xxl:col-span-5 w-full">
                                <div class="flex justify-center mt-8">
                                    <div class="flex items-center mr-5">
                                        <div class="w-2 h-2 bg-theme-1 rounded-full mr-3"></div>
                                        <span>Product Profit</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-gray-400 rounded-full mr-3"></div>
                                        <span>Author Sales</span>
                                    </div>
                                </div>
                                <div class="report-chart mt-8">
                                    <canvas id="stacked-bar-chart-1" height="130"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: General Statistic -->
                </div>
            </x-tab>
        </x-tabs>
    </div>

    <?php
    $values = [
        ['id' => '1', 'name' => 'mek', 'selected' => 'selected'],
        ['id' => '2', 'name' => 'erku', 'selected' => ''],
        ['id' => '3', 'name' => 'ereq', 'selected' => 'selected'],
        ['id' => '4', 'name' => 'chors', 'selected' => ''],
    ];
    ?>

    <div class="intro-y box mt-5">
        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Searchable Select
            </h2>
        </div>
        <x-searchable-select :values="$values" class="p-5"/>
    </div>
</x-app-layout>
