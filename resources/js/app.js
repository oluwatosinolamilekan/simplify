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
            console.log(date1.dateInstance);
            console.log(date2.dateInstance);
        });
    },
})
