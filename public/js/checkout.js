(async () => {
    'use strict';

    let invoiceUrl;

    // configuration form elements
    const buttonStartDemo = document.getElementById('button-start-demo');
    const formConfigure = document.getElementById('form-configure');

    // modal elements
    const modal = document.querySelector('.modal-popup');
    const modalCloseTrigger = document.querySelector(
        '.modal-popup__icon-close'
    );
    const bodyBlackout = document.querySelector('.modal-background');
    const iframe = document.getElementById('iframe-invoice');

    formConfigure.addEventListener('submit', (event) => {
        event.preventDefault();
        startDemo();
    });

    modalCloseTrigger.addEventListener('click', () => {
        modal.classList.remove('modal-popup--visible');
        bodyBlackout.classList.remove('modal-background--blackout');
    });


    // handles invoice creation upon checkout demo launch
    const startDemo = async () => {
        loadingDemoLaunch();

        if (!invoiceUrl) {
            // setup invoice data

            const {
                currency,
                amount
            } = {
                amount: 14000000,
                currency: 'IDR'
            };
            const invoiceData = {
                currency,
                amount,
                redirect_url: `${window.location.origin}/try-checkout`
            };

            // create an invoice for store checkout
            try {
                const response = await fetch('/api/mobile/invoice', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8'
                    },
                    body: JSON.stringify(invoiceData)
                });

                const data = await response.json();

                if (response.status >= 200 && response.status <= 299 && typeof data.invoice_url !== 'undefined')
                    invoiceUrl = data.invoice_url;
                else alert(data.message);
            } catch (error) {
                alert(error);
            }
        }

        if (invoiceUrl) {
            // launchModal();
            redirectToInvoice();
        }

        loadingDemoLaunch();
    };

    // handles pop-up dialog option
    const launchModal = () => {
        iframe.src = invoiceUrl;
        modal.classList.add('modal-popup--visible');
        bodyBlackout.classList.add('modal-background--blackout');
    };

    // handles redirection option
    const redirectToInvoice = () => {
        window.location.href = invoiceUrl;
    };

    // handles button behaviour upon demo launch
    const loadingDemoLaunch = () => {
        buttonStartDemo.disabled = !buttonStartDemo.disabled;
    };

    // avoid animation during page load
    document.body.classList.remove('preload');
})();
