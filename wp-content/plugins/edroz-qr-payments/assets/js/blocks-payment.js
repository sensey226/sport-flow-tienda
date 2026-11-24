(function () {
    if (!window.wc || !window.wc.wcBlocksRegistry || !window.wc.wcSettings || !window.wp || !window.wp.element) return;

    const { registerPaymentMethod } = window.wc.wcBlocksRegistry;
    const { getSetting } = window.wc.wcSettings;
    const { createElement, useState, useEffect, Fragment } = window.wp.element;
    const useSelect = window.wp.data && window.wp.data.useSelect ? window.wp.data.useSelect : null;

    function escHtml(html) {
        const div = document.createElement('div');
        div.innerHTML = html || '';
        return div.textContent || div.innerText || '';
    }

    function registerGateway(id, brand) {
        const settings = getSetting(id + '_data', {});
        const Content = (props) => {
            const [operation, setOperation] = useState('');
            const required = settings.operation_required === 'yes';
            const cartTotals = useSelect ? useSelect((select) => {
                const cart = select('wc/store/cart');
                return cart && cart.getCartTotals ? cart.getCartTotals() : null;
            }, []) : null;
            const totalPrice = cartTotals && cartTotals.total_price ? Number(cartTotals.total_price) / Math.pow(10, Number(cartTotals.currency_minor_unit || 2)) : 0;
            const currency = (cartTotals && cartTotals.currency_code) || settings.currency_code || 'PEN';
            const formattedTotal = totalPrice > 0 ? new Intl.NumberFormat('es-PE', { style: 'currency', currency: currency }).format(totalPrice) : '';
            const copy = () => {
                if (!settings.phone) return;
                if (navigator.clipboard) navigator.clipboard.writeText(settings.phone);
            };
            useEffect(() => {
                if (!props.eventRegistration || !props.eventRegistration.onPaymentSetup) return;
                return props.eventRegistration.onPaymentSetup(() => ({
                    type: props.emitResponse.responseTypes.SUCCESS,
                    meta: { paymentMethodData: { yape_plin_operation: operation } }
                }));
            }, [operation, props.eventRegistration, props.emitResponse]);

            const rows = [];
            if (settings.holder) rows.push(createElement('div', { key: 'holder' }, createElement('strong', null, 'Titular: '), settings.holder));
            if (settings.company) rows.push(createElement('div', { key: 'company' }, createElement('strong', null, 'Empresa: '), settings.company));
            if (settings.tax_id) rows.push(createElement('div', { key: 'tax' }, createElement('strong', null, 'RUC / documento: '), settings.tax_id));
            if (settings.phone) rows.push(createElement('div', { key: 'phone' }, createElement('strong', null, 'Celular: '), settings.phone));

            return createElement(Fragment, null,
                createElement('div', { className: 'edroz-block-payment' },
                    settings.description ? createElement('div', { className: 'edroz-payment-description' }, escHtml(settings.description)) : null,
                    formattedTotal ? createElement('div', { className: 'edroz-amount' },
                        createElement('div', { className: 'edroz-amount-icon' }, '✓'),
                        createElement('div', { className: 'edroz-amount-copy' },
                            createElement('span', { className: 'edroz-amount-label' }, 'Monto exacto a ingresar'),
                            createElement('strong', { className: 'edroz-amount-value' }, formattedTotal),
                            createElement('small', null, 'Escribe este mismo monto en Yape antes de confirmar tu pago.')
                        )
                    ) : null,
                    createElement('div', { className: 'edroz-steps' },
                        createElement('div', null, createElement('span', null, '1'), createElement('strong', null, 'Escanea')),
                        createElement('div', null, createElement('span', null, '2'), createElement('strong', null, 'Ingresa el monto')),
                        createElement('div', null, createElement('span', null, '3'), createElement('strong', null, 'Confirma'))
                    ),
                    settings.show_qr === 'yes' && settings.qr_url ? createElement('div', { className: 'edroz-qr-wrap' }, createElement('img', { src: settings.qr_url, alt: 'Código QR de ' + brand, loading: 'lazy' })) : null,
                    createElement('div', { className: 'edroz-data' }, rows),
                    settings.phone ? createElement('div', { className: 'edroz-actions' },
                        settings.show_copy === 'yes' ? createElement('button', { type: 'button', className: 'edroz-copy', onClick: copy }, 'Copiar número') : null,
                        settings.show_contact === 'yes' ? createElement('a', { className: 'edroz-contact', href: 'tel:' + String(settings.phone).replace(/[^0-9+]/g, '') }, 'Llamar') : null
                    ) : null,
                    settings.operation_field === 'yes' ? createElement('div', { className: 'edroz-operation-field' },
                        createElement('label', null, 'Número de operación', required ? createElement('span', { className: 'required' }, ' *') : null),
                        createElement('input', { type: 'text', inputMode: 'numeric', value: operation, required: required, onChange: (e) => setOperation(e.target.value), placeholder: 'Ej. 123456789' })
                    ) : null,
                    createElement('div', { className: 'edroz-tip' }, '💡 Después de pagar, registra tu número de operación para que podamos identificar tu pago más rápido.')
                )
            );
        };
        const Label = () => createElement('span', { className: 'edroz-payment-label' },
            createElement('span', { className: 'edroz-payment-label-text' }, settings.title || ('Paga con ' + brand)),
            settings.icon ? createElement('img', { className: 'edroz-payment-label-icon', src: settings.icon, alt: brand }) : null
        );
        registerPaymentMethod({
            name: id,
            label: createElement(Label),
            content: createElement(Content),
            edit: createElement(Content),
            ariaLabel: settings.title || ('Paga con ' + brand),
            canMakePayment: () => true,
            supports: { features: ['products'] }
        });
    }

    registerGateway('yapepay', 'Yape');
})();
