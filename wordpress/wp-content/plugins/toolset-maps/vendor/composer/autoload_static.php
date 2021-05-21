<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit732bc89550c68ca52c3e9b4c405982a9
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Toolset\\DynamicSources\\' => 23,
            'ToolsetCommonEs\\' => 16,
        ),
        'O' => 
        array (
            'OTGS\\Toolset\\Maps\\Model\\' => 24,
            'OTGS\\Toolset\\Maps\\Controller\\Troubleshooting\\' => 45,
            'OTGS\\Toolset\\Maps\\Controller\\Compatibility\\Gutenberg\\EditorBlocks\\Blocks\\Map\\' => 77,
            'OTGS\\Toolset\\Maps\\Controller\\Compatibility\\Gutenberg\\EditorBlocks\\' => 66,
            'OTGS\\Toolset\\Maps\\Controller\\Compatibility\\' => 43,
            'OTGS\\Toolset\\Maps\\Controller\\' => 29,
            'OTGS\\Toolset\\Maps\\' => 18,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
        'A' => 
        array (
            'Auryn\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Toolset\\DynamicSources\\' => 
        array (
            0 => __DIR__ . '/..' . '/toolset/dynamic-sources/server',
        ),
        'ToolsetCommonEs\\' => 
        array (
            0 => __DIR__ . '/..' . '/toolset/common-es/server',
        ),
        'OTGS\\Toolset\\Maps\\Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application/models',
        ),
        'OTGS\\Toolset\\Maps\\Controller\\Troubleshooting\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application/controllers/troubleshooting',
        ),
        'OTGS\\Toolset\\Maps\\Controller\\Compatibility\\Gutenberg\\EditorBlocks\\Blocks\\Map\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application/controllers/compatibility/gutenberg/editor-blocks/blocks/map',
        ),
        'OTGS\\Toolset\\Maps\\Controller\\Compatibility\\Gutenberg\\EditorBlocks\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application/controllers/compatibility/gutenberg/editor-blocks',
        ),
        'OTGS\\Toolset\\Maps\\Controller\\Compatibility\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application/controllers/compatibility',
        ),
        'OTGS\\Toolset\\Maps\\Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application/controllers',
        ),
        'OTGS\\Toolset\\Maps\\' => 
        array (
            0 => __DIR__ . '/../..' . '/application',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
        'Auryn\\' => 
        array (
            0 => __DIR__ . '/..' . '/rdlowrey/auryn/lib',
        ),
    );

    public static $classMap = array (
        'Toolset_Addon_Maps_CRED' => __DIR__ . '/../..' . '/includes/toolset-maps-cred.class.php',
        'Toolset_Addon_Maps_Common' => __DIR__ . '/../..' . '/includes/toolset-common-functions.php',
        'Toolset_Addon_Maps_Types' => __DIR__ . '/../..' . '/includes/google_address.php',
        'Toolset_Addon_Maps_Views' => __DIR__ . '/../..' . '/includes/toolset-maps-views.class.php',
        'Toolset_Addon_Maps_Views_Distance_Filter' => __DIR__ . '/../..' . '/includes/toolset-views-maps-distance-filter.php',
        'Toolset_Maps_Ajax_Handler_Add_To_Cache' => __DIR__ . '/../..' . '/application/controllers/Ajax/Handler/Toolset_Maps_Ajax_Handler_Add_To_Cache.php',
        'Toolset_Maps_Ajax_Handler_Update_Address_Cache' => __DIR__ . '/../..' . '/application/controllers/Ajax/Handler/UpdateAddressCache.php',
        'Toolset_Maps_Geolocation_Shortcode' => __DIR__ . '/../..' . '/includes/toolset-maps-geolocation-shortcode.php',
        'Toolset_Maps_Location' => __DIR__ . '/../..' . '/includes/toolset-maps-location.php',
        'Toolset_Maps_Location_Factory' => __DIR__ . '/../..' . '/includes/toolset-maps-location-factory.php',
        'Toolset_Maps_Shortcode_Generator' => __DIR__ . '/../..' . '/includes/toolset-maps-shortcode-generator.php',
        'Toolset_Maps_Views_Distance' => __DIR__ . '/../..' . '/includes/toolset-maps-views-distance.php',
        'Toolset_Maps_Views_Distance_Order' => __DIR__ . '/../..' . '/includes/toolset-maps-views-distance-order.php',
        'WPToolset_Field_google_address' => __DIR__ . '/../..' . '/includes/toolset-maps-types.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit732bc89550c68ca52c3e9b4c405982a9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit732bc89550c68ca52c3e9b4c405982a9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit732bc89550c68ca52c3e9b4c405982a9::$classMap;

        }, null, ClassLoader::class);
    }
}
