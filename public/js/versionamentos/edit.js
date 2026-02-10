document.addEventListener('DOMContentLoaded', function () {
    const releaseDateInput = document.getElementById('release_date');
    
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
    if (element && typeof Choices !== 'undefined') {
        new Choices(element, {
            removeItemButton: true,
            placeholder: true,
            placeholderValue: 'Selecione os responsáveis...',
            searchPlaceholderValue: 'Pesquisar...',
            shouldSort: false,
            noResultsText: 'Nenhum resultado encontrado',
            noChoicesText: 'Nenhuma opção para escolher',
            itemSelectText: 'Pressione para selecionar'
        });
    }
});