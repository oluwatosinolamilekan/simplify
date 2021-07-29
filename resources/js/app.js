require('./bootstrap');

require('cash-dom');
require('litepicker');
require('alpinejs');
require('./theme');

let datepicker = document.getElementById('datepicker');
if(datepicker) {
    new Litepicker({
        element: datepicker,
        singleMode: false,
        setup: (picker) => {
            picker.on('selected', (date1, date2) => {
                picker.options.element.dispatchEvent(new Event('selected'));
            });
        },
    });
}
