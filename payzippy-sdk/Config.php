<?php

final class PZ_Config
{
    const MERCHANT_ID = "AAHARI"; // Your Merchant ID Test --test_t744
    const SECRET_KEY = "af688ca8122da50324190f90d443b8ffaabf72e38ccc08bcad8c14cddae45aa8"; // Your Secret Key. Do not share this.
    //Test -- 9f498ec70c4aabc7233fc854025eaabbc2ca6b480fe42f7d4aebdb540b8ce0f5
    const TRANSACTION_TYPE = "SALE";
    const CURRENCY = "INR";
    const UI_MODE = "REDIRECT"; // UI Integration - REDIRECT or IFRAME
    const HASH_METHOD = "SHA256"; // MD5 or SHA256
    const MERCHANT_KEY_ID = "payment"; // Your Merchant Key ID
    const CALLBACK_URL = ""; // Your callback URL

    const API_BASE = "https://www.payzippy.com/payment/api/";
    const API_CHARGING = "charging";
    const API_QUERY = "query";
    const API_REFUND = "refund";
    const API_VERSION = "v1";
    const VERIFY_SSL_CERTS = TRUE;
}
?>
