<?php
/*
 * Stripe API keys — TEMPLATE.
 *
 * Copy this file to config/api_key.php and fill in your real keys:
 *
 *     copy config\api_key.example.php config\api_key.php
 *
 * Get the keys from your Stripe dashboard:
 *     https://dashboard.stripe.com/test/apikeys
 *
 * config/api_key.php is git-ignored on purpose so real keys are never
 * committed. Only this example file should be tracked by git.
 */

// Secret key — used only on the server. NEVER expose or commit this.
define('STRIPE_KEY', 'sk_test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');

// Publishable key — safe for the browser. Keep js/stripe.js in sync with this.
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx');
