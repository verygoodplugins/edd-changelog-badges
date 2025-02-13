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
