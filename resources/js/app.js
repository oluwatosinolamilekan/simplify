require('./bootstrap');

require('cash-dom');
require('litepicker');
require('alpinejs');
require('./theme');

new Litepicker({
    element: document.getElementById('datepicker'),
    singleMode: false,
    setup: (picker) => {
        picker.on('selected', (date1, date2) => {
            picker.options.element.dispatchEvent(new Event('selected'));
        });
    },
})
