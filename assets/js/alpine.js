document.addEventListener('alpine:init', function () {
    Alpine.data('dropdown', () => ({
        open: false,
        toggle() {
            this.open = ! this.open
        }
    }));

    Alpine.data('payments', () => ({
        payment: 'card',
        change(selectedElement) {
            this.payment = selectedElement;
        }
    }));
})
