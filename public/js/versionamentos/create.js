document.addEventListener('DOMContentLoaded', function() {
    const releaseDateInput = document.querySelector('#release_date');

    if (releaseDateInput && typeof flatpickr !== 'undefined') {
        flatpickr(releaseDateInput, {
            altInput: true,              
            altFormat: "d/m/Y",           
            dateFormat: "Y-m-d",         
            
            locale: "pt",
            allowInput: true,
            disableMobile: true,
            monthSelectorType: "static",
            yearSelectorType: "static",
            position: "auto",
            theme: "light",
            static: true,
            clickOpens: true,
            defaultDate: releaseDateInput.value || null, 
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