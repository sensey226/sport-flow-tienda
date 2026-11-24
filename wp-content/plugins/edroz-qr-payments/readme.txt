=== Edroz QR Payments ===
Contributors: edroze
Tags: yape, payments, peru, qr, ecommerce
Requires at least: 5.8
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 7.2.7
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Manual QR payments for WooCommerce using Yape, QR codes, and optional transaction number registration.

== Description ==

Edroz QR Payments adds a manual Yape payment method to WooCommerce.

It displays the payment details configured by the store, supports a QR code, lets customers copy the phone number, and optionally records the transaction number with the order.

The free version works independently. It does not require a license or external services.

== Features ==

* Manual Yape payment method for WooCommerce.
* QR code selection from the WordPress Media Library.
* Displays the exact order amount.
* Button to copy the mobile phone number.
* Option to add the phone number to contacts.
* Optional transaction number registration.
* Option to make the transaction number required.
* Configurable initial order status.
* Shipping method restrictions.
* Option to enable or disable the method for virtual orders.
* Classic WooCommerce checkout integration.
* WooCommerce Checkout Blocks integration.
* Custom administration panel to manage Edroz QR Payments and the Yape payment method.

== Free version ==

Edroz QR Payments is the free edition of our QR payment system for WooCommerce.

The free version includes the Yape payment method and works independently, without requiring a license or another plugin.

== PRO version ==

If you need additional payment methods and features, you can use our separate PRO version.

Edroz QR Payments PRO adds:

* Plin.
* Bank transfer.
* Transfer receipts.
* Bank management.
* Additional tools for the payment process.
* Checkout improvements.
* PRO-only features.

The PRO version is a separate product and is not required to use Edroz QR Payments.

More information about the PRO version:

https://edroz-design.com/plugins/

== Requirements ==

* WordPress 5.8 or later.
* WooCommerce installed and active.
* PHP 7.4 or later.

== Installation ==

1. Install and activate WooCommerce.
2. Go to Plugins > Add New > Upload Plugin.
3. Upload the Edroz QR Payments ZIP file and activate the plugin.
4. Open Edroz QR Payments from the WordPress administration menu.
5. Configure Yape for your store.
6. Save the settings and place a test order.

== Configuration ==

The Edroz QR Payments dashboard displays the system status and provides access to the Yape payment method.

Yape settings include the payment title, description, account holder, mobile phone number, business name, document number, QR code, copy and contact buttons, transaction number, initial order status, and other available options.

== Screenshots ==

1. Edroz QR Payments status dashboard.
2. Yape payment method management and activation.
3. EDROZ - Yape payment method settings.
4. EDROZ - Yape listed among WooCommerce payment methods.
5. Customer checkout experience with QR code and transaction number field.

== Frequently Asked Questions ==

= Do I need an account or a license? =

No. The free version works without an account or license.

= Do I need to install the PRO version? =

No. Edroz QR Payments works independently with Yape. The PRO version is optional and adds Plin, bank transfer, and additional features.

= Does the plugin work with WooCommerce Checkout Blocks? =

Yes. The plugin includes WooCommerce Checkout Blocks integration.

= Does the plugin process payments automatically? =

No. Yape works as a manual payment method. The customer makes the payment through Yape, and the store verifies it before processing the order.

= Can I register the transaction number? =

Yes. The transaction number can be optional or required, depending on the store settings.

= Does the plugin require an external server? =

No. The free version does not require a license server or external services to operate.

== Changelog ==

= 7.2.7-lab =
* Added a Yape payment review screen in the Edroz administration panel.
* Added manual approval and rejection actions for Yape orders.
* Approval and rejection update the WooCommerce order status and add an order note.

= 7.2.6 =
* Fix Yape payment details and QR display in Elementor-based checkout pages.
* Improve compact layout of the Yape payment card in checkout.
* Keep the transaction number saved in the WooCommerce order for administrator verification.


= 7.2.5 =
* Declared compatibility with WooCommerce HPOS and Checkout Blocks.
* Escaped generated status badge HTML before output.
* Updated the readme file to English.

= 7.2.4 =
* Added a custom administration panel for Edroz QR Payments.
* Added the plugin status section.
* Added Yape payment method management from the dashboard.
* Added an option to enable or disable Yape from the dashboard.
* Improved the plugin administration layout.
* Removed unnecessary Yape configuration fields.
* Updated the plugin documentation and described PRO as a separate product.

= 7.2.3 =
* Renamed the plugin to Edroz QR Payments and updated its slug and text domain for WordPress.org.
* Replaced the inline QR administration script with a properly enqueued script.

= 7.2.2 =
* Improved compatibility with the WordPress.org Plugin Check requirements.
* Updated the displayed plugin name.
* Improved output escaping and translation comments.

= 7.2.1 =
* Updated the plugin website link.

= 7.2.0 =
* First edition prepared for the WordPress.org plugin directory.
* Free edition focused on Yape.
* Removed the license system from the directory edition.
* Removed premium feature restrictions.
* Retained WooCommerce Checkout Blocks integration.
* Retained QR code, order amount, copy, contact, and transaction number features.


= 7.2.7-lab3 =
* Laboratorio: descuento configurable por Yape.
* Recordatorio de pago por WhatsApp desde la verificación.
* Temporizador informativo configurable, sin cancelación automática.
* Estadísticas de aprobaciones de los últimos 7 días y del mes.
* Acciones masivas con validación de permisos, nonce y prevención de decisiones repetidas.
