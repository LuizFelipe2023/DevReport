document.addEventListener('DOMContentLoaded', function () {

    const releaseDateInput = document.getElementById('release_date');

    if (releaseDateInput && typeof flatpickr !== 'undefined') {
        flatpickr(releaseDateInput, {
            dateFormat: "d/m/Y",
            locale: "pt",
            allowInput: true,
            disableMobile: true,
            monthSelectorType: "static",
            yearSelectorType: "static",
            position: "auto",
            theme: "light",
            static: true,
            wrap: false,
            clickOpens: true,
            time_24hr: true,
            defaultDate: releaseDateInput.value || null,
            parseDate: (datestr, format) => {
                return flatpickr.parseDate(datestr, format);
            }
        });
    }
    const element = document.querySelector('#users-select');
    if (element) {
        new Choices(element, {
            removeItemButton: true,
            placeholderValue: 'Selecione os responsáveis...',
            shouldSort: false,
        });
    }
});