# elementor-scripts
I got a WP theme and _elementor_data keeps overriding my post_content AKA (Description)
So, I made the script to prevent that from happening again.
Permanently disables Elementor's content override for all products.
This function hooks into the product saving process and deletes the '_elementor_data' meta field, forcing the theme to use the standard WordPress content editor (the long description).

## The script should be in the theme's functions.php file (use Child theme).

