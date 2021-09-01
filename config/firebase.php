<?php

declare(strict_types=1);

return [
    /*
     * ------------------------------------------------------------------------
     * Default Firebase project
     * ------------------------------------------------------------------------
     */
    'default' => env('FIREBASE_PROJECT', 'app'),

    /*
     * ------------------------------------------------------------------------
     * Firebase project configurations
     * ------------------------------------------------------------------------
     */
    'projects' => [
        'app' => [
            /*
             * ------------------------------------------------------------------------
             * Credentials / Service Account
             * ------------------------------------------------------------------------
             *
             * In order to access a Firebase project and its related services using a
             * server SDK, requests must be authenticated. For server-to-server
             * communication this is done with a Service Account.
             *
             * If you don't already have generated a Service Account, you can do so by
             * following the instructions from the official documentation pages at
             *
             * https://firebase.google.com/docs/admin/setup#initialize_the_sdk
             *
             * Once you have downloaded the Service Account JSON file, you can use it
             * to configure the package.
             *
             * If you don't provide credentials, the Firebase Admin SDK will try to
             * auto-discover them
             *
             * - by checking the environment variable FIREBASE_CREDENTIALS
             * - by checking the environment variable GOOGLE_APPLICATION_CREDENTIALS
             * - by trying to find Google's well known file
             * - by checking if the application is running on GCE/GCP
             *
             * If no credentials file can be found, an exception will be thrown the
             * first time you try to access a component of the Firebase Admin SDK.
             *
             */
            'credentials' => [
                'file' => '{"type": "service_account","project_id": "loaschedule","private_key_id": "c406323eb6c946f167111339dde7ec49c6f3f8e9","private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCw8rNGV6OjWXu/\nwiw92iMBuvx45TWPOyFr3M/mAMnsu9oO7O3LGUSZF86Ruh7ohnsZSaqhofVWcyR1\n6WIrwx110TIL5VE2Abyqi1SeLzZCuXnOyJ21pweFr2Qsi5MvqoDB6drlXl5ZU/ex\n0R9RDEI7ReOSKMYkeId/Lg6su5Ny4BRfAbhnL0y6PWqjjGWVQv/tVLtg/yvFt4yO\nYxJl8VAek+SBvXkMe6L7IhFAHLdjjJabLH4nuyZNysnZvBnUT71sUOFJzYSfEqFJ\nzEbCHMJyUZCSkbHmnv6HKkfGVVDs2m2zKJhievFltYsTHT3JTdmlCw45iE0urW0O\n8NLAYZqDAgMBAAECggEABxXOFYt4exfKq4zQA7FX2dUNu0jbl6lzoaOHqZCE2qyn\nmGsRQc14YImXqmB2+12N0UnmAgR/qTSsFD1CQo6p/9KJZqOJ2G1CYNvPtBPKNZVt\nVK6Aw3TK3tCn5LFkCoe7vHKrjVKgLth8tbXcw1HdLGK/MCuKH4y59DQ5FIk1krxo\nDC0/bmF+lM361jk6r63SI+/siPNX+eJI4jT1KCpN8fXvSL8CybxJKxQtWYEPlh8W\nwzMaJdG97Dfw1dVRY6EaDXVG9sxnGnwuxYj4c8zs6uKR0niZDqhyEYZShFJj64Bz\nSXvvulyHd8Pk7JvKAze40GGszljKZGixCCcm3wnCiQKBgQDxMRJA6uARAN1kUCBl\ntwXJtrikSUbGTaSA5Yf//DyHAg0JIkjQc/0oSLlojgsCbys9qT/e/0yYkOX4L5W5\nAepUIt+wRmU3i+BJwBSIL1/Fca32qcDv+C5V4ESQQlw9hoZpENPT98dMGUBbt6XR\nHN2urhgH7Jf2ZrRWmNx1uM6yWwKBgQC7z+FLZQBMhezdHyRvgyN1a36Q+7viCmGR\nOqq23K2jFoXK3lRVBBb7qUlJK/j78MDuD9aKWpoe62RZsb6GlKk+LZcyVtRq57lu\nJkDXt0SmQyPhvQFBeb9+VRNmpRG/878a5jUbNiS2SxKrL8HlUM+0EVrvRoX29n+a\n9LAO95xg+QKBgG6gv2qfUN77spCMYA/HfxQih1Zzdc8HVej5XwP/QhP60NfbreJP\nEVMk6EYYwNwA+ahytSUnnI5uB81qphYR1tV4mXlVEKAFvH6XZ9N/R0Jc/hohiqmH\nAFnLYCd7CKv/xC701PRotjUlb+uhtKDRyKySldssnhcazKTbwGMOvV/5AoGAIG58\nVB2j2JMD3QdErnDxzZP7biPaROVQBdkgo6Ul4tS/09FitK+ZHGoWOql6PF9NoY5g\nmNGebZpuYMK9yNWhCBitVEcENVXAgpHefqGqHB/Z8WBG+DyC4djlGcOFdiUsKgP4\nxbMq0cPS/Hapv+SdiVW54znFZmkYjfSU9nCxs1kCgYBEN9u9nLMqwiZL1tzqucm/\ng7CKj5H7rmZ1IfcHPHhrNS0vDmrCuAo97+QqFDgHJT/PzNE4eYHFmdLKzwwSNczl\nNBdv+qfIraYB/Fl5P5ffUiPatlAOJS2kRx2QJtghpQQ8F98WOrQjgv8vY0D2arwH\n9dzmAMa5R+WNFxhGth7zyA==\n-----END PRIVATE KEY-----\n","client_email": "firebase-adminsdk-109lu@loaschedule.iam.gserviceaccount.com","client_id": "106136738810979589423","auth_uri": "https://accounts.google.com/o/oauth2/auth","token_uri": "https://oauth2.googleapis.com/token","auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs","client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-109lu%40loaschedule.iam.gserviceaccount.com"}',

                /*
                 * If you want to prevent the auto discovery of credentials, set the
                 * following parameter to false. If you disable it, you must
                 * provide a credentials file.
                 */
                'auto_discovery' => true,
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Auth Component
             * ------------------------------------------------------------------------
             */

            'auth' => [
                'tenant_id' => env('FIREBASE_AUTH_TENANT_ID'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Realtime Database
             * ------------------------------------------------------------------------
             */

            'database' => [
                /*
                 * In most of the cases the project ID defined in the credentials file
                 * determines the URL of your project's Realtime Database. If the
                 * connection to the Realtime Database fails, you can override
                 * its URL with the value you see at
                 *
                 * https://console.firebase.google.com/u/1/project/_/database
                 *
                 * Please make sure that you use a full URL like, for example,
                 * https://my-project-id.firebaseio.com
                 */
                'url' => env('FIREBASE_DATABASE_URL'),
            ],

            'dynamic_links' => [
                /*
                 * Dynamic links can be built with any URL prefix registered on
                 *
                 * https://console.firebase.google.com/u/1/project/_/durablelinks/links/
                 *
                 * You can define one of those domains as the default for new Dynamic
                 * Links created within your project.
                 *
                 * The value must be a valid domain, for example,
                 * https://example.page.link
                 */
                'default_domain' => env('FIREBASE_DYNAMIC_LINKS_DEFAULT_DOMAIN'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Firebase Cloud Storage
             * ------------------------------------------------------------------------
             */

            'storage' => [
                /*
                 * Your project's default storage bucket usually uses the project ID
                 * as its name. If you have multiple storage buckets and want to
                 * use another one as the default for your application, you can
                 * override it here.
                 */

                'default_bucket' => env('FIREBASE_STORAGE_DEFAULT_BUCKET'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Caching
             * ------------------------------------------------------------------------
             *
             * The Firebase Admin SDK can cache some data returned from the Firebase
             * API, for example Google's public keys used to verify ID tokens.
             *
             */

            'cache_store' => env('FIREBASE_CACHE_STORE', 'file'),

            /*
             * ------------------------------------------------------------------------
             * Logging
             * ------------------------------------------------------------------------
             *
             * Enable logging of HTTP interaction for insights and/or debugging.
             *
             * Log channels are defined in config/logging.php
             *
             * Successful HTTP messages are logged with the log level 'info'.
             * Failed HTTP messages are logged with the the log level 'notice'.
             *
             * Note: Using the same channel for simple and debug logs will result in
             * two entries per request and response.
             */

            'logging' => [
                'http_log_channel' => env('FIREBASE_HTTP_LOG_CHANNEL'),
                'http_debug_log_channel' => env('FIREBASE_HTTP_DEBUG_LOG_CHANNEL'),
            ],

            /*
             * ------------------------------------------------------------------------
             * HTTP Client Options
             * ------------------------------------------------------------------------
             *
             * Behavior of the HTTP Client performing the API requests
             */
            'http_client_options' => [
                /*
                 * Use a proxy that all API requests should be passed through.
                 * (default: none)
                 */
                'proxy' => env('FIREBASE_HTTP_CLIENT_PROXY'),

                /*
                 * Set the maximum amount of seconds (float) that can pass before
                 * a request is considered timed out
                 * (default: indefinitely)
                 */
                'timeout' => env('FIREBASE_HTTP_CLIENT_TIMEOUT'),
            ],

            /*
             * ------------------------------------------------------------------------
             * Debug (deprecated)
             * ------------------------------------------------------------------------
             *
             * Enable debugging of HTTP requests made directly from the SDK.
             */
            'debug' => env('FIREBASE_ENABLE_DEBUG', false),
        ],
    ],
];
