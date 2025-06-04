<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'inertia' => env('SEO_TOOLS_INERTIA', false),
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => 'Truth Transparent',
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => 'An examination of the historical inevitability and systemic historical origins of post-capitalist, post-socialist, post-communist and possible post-postist forms of social self-governance.',
            'separator'    => ' | ',
            'keywords'     => ['post-scarcity economics', 'ontological idealism', 'anarchic love-based societal governance', 'consciousness-first reality', 'localised power', 'health as wealth'],
            'canonical'    => 'current', // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots'       => 'all', // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Truth Transparent',
            'description' => 'An examination of the historical inevitability and systemic historical origins of post-capitalist, post-socialist, post-communist and possible post-postist forms of social self-governance.',
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => 'articles',
            'site_name'   => 'Truth Transparent',
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => 'Truth Transparent',
            'description' => 'An examination of the historical inevitability and systemic historical origins of post-capitalist, post-socialist, post-communist and possible post-postist forms of social self-governance.',
            'url'         => null, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
