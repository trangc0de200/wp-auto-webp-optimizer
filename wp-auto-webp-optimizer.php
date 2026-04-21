<?php
/**
 * Plugin Name: WP Auto WebP Optimizer
 * Plugin URI:  https://web.minhbee.vn
 * Description: Automatically convert all uploaded images (JPG, JPEG, PNG) to WebP format with 80% compression to optimize page load speed..
 * Version:     1.0.0
 * Author:      trangc0de200
 * License:     GPL-2.0+
 */

// Prevent direct access to plugin files for security reasons.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class WP_Auto_WebP_Optimizer {

    // The default compression quality is declared as 80.
    private $quality = 80;

    public function __construct() {
        // Register hooks when the plugin is initialized.
        add_filter( 'big_image_size_threshold', '__return_false' );
        add_filter( 'wp_handle_upload', [ $this, 'convert_upload_to_webp' ] );
        add_filter( 'wp_editor_set_quality', [ $this, 'set_global_webp_quality' ], 10, 2 );
    }

    /**
     * The function handles file conversion immediately upon upload.
     */
    public function convert_upload_to_webp( $upload ) {
        // Check for errors and file formats (only handles JPG/JPEG and PNG)
        if ( isset( $upload['error'] ) || ! in_array( $upload['type'], [ 'image/jpeg', 'image/png' ] ) ) {
            return $upload;
        }

        // Check if your server supports WebP.
        if ( ! wp_image_editor_supports( [ 'mime_type' => 'image/webp' ] ) ) {
            return $upload;
        }

        $file_path = $upload['file'];
        $editor = wp_get_image_editor( $file_path );

        if ( is_wp_error( $editor ) ) {
            return $upload;
        }

        // Set the compression level to 80% for the original file.
        $editor->set_quality( $this->quality );

        // Create a new file name and path (.webp).
        $path_info = pathinfo( $file_path );
        $new_filename = $path_info['filename'] . '.webp';
        $new_file_path = $path_info['dirname'] . '/' . $new_filename;

        // Save file
        $saved = $editor->save( $new_file_path, 'image/webp' );

        // If the save is successful, update the information and clean up.
        if ( ! is_wp_error( $saved ) ) {
            @unlink( $file_path ); // Delete the original JPG/PNG file.

            $upload['file'] = $new_file_path;
            $upload['url']  = str_replace( basename( $upload['url'] ), $new_filename, $upload['url'] );
            $upload['type'] = 'image/webp';
        }

        return $upload;
    }

    /**
     * The function applies 80% compression to all sub-size images that are automatically cropped by WP.
     */
    public function set_global_webp_quality( $quality, $mime_type ) {
        if ( 'image/webp' === $mime_type ) {
            return $this->quality;
        }
        return $quality;
    }
}

// Kích hoạt Plugin
new WP_Auto_WebP_Optimizer();
