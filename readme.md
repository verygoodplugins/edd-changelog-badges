# EDD Changelog
A WordPress plugin that adds a beautiful changelog display shortcode for Easy Digital Downloads products.

<img width="875" alt="image" src="https://github.com/user-attachments/assets/a46918ff-b81a-41bb-99ac-802e7a2193bc" />

## Features
- Adds `[edd_changelog]` shortcode to display product changelogs
- Automatically adds visual badges for New, Improved, Fixed, and Dev changes
- Styled layout with clear visual hierarchy
- Compatible with EDD Software Licensing changelog field

## Installation
1. Upload the `edd-changelog` folder to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the shortcode `[edd_changelog id="123"]` in your posts/pages where 123 is your EDD product ID

## Usage
Basic usage: `[edd_changelog id="123"]`

The plugin will automatically style changelog entries based on these prefixes:
- Added: Shows a green "New" badge
- Improved: Shows a blue "Improved" badge  
- Fix: Shows an orange "Fixed" badge
- Developer: Shows a gray "Dev" badge 

## Customization
The plugin uses the `edd_changelog_badge_configs` filter to allow for custom badge configurations.

Example:
```php  
add_filter( 'edd_changelog_badge_configs', function( $configs ) {
    $configs['added']['emoji']     = '🚀';
    $configs['improved']['emoji']  = '🔄';
    $configs['fix']['emoji']       = '🐛';
    $configs['developer']['emoji'] = '👨‍💻';

    return $configs;
} );
```
Each badge config accepts these parameters:
- `prefix`: Text to match at the start of changelog items
- `badge_text`: Text displayed on the badge
- `emoji`: Emoji shown before badge text
- `class`: CSS class for styling the badge
- `ltrim`: Text to remove from the start of matched items (optional)

## Changelog
= 1.1.0 =
* Added `edd_changelog_badge_configs` filter to allow for custom badge configurations

= 1.0.0 - Feb 13, 2025 =
* Initial release