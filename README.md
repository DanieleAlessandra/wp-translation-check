# .mo File Checker

This script scans a directory for `.mo` translation files, loads them, and verifies the presence of a specific translated string.

## Instructions

1. **Insert the Script**: Place the `check.php` script in the directory where your plugin or theme translation files are located. For example: `wp-content/plugins/your-plugin/languages/check.php`
2. **Modify the Path**: Ensure the `require_once` path in the script points correctly to your `wp-load.php`. The default path is set to:
```php
require_once( __DIR__ . '/../../../../wp-load.php' );
```
3. **Access the Script**: Open your web browser and navigate to this file in your plugin's language directory, i.e.: `//<your-website>/wp-content/plugins/<your-plugin>/languages/check.php`
4. **Check the Output**: The script will load each .mo file in the directory and check if the string `Hello, this is a translated message!` has been translated. The results will be printed for each file.

Text domain is not relevant for this script to work, however the locale must be part of the name, i.e.: `<file_name>-<locale>.mo`. This script extracts locale from there.

# Purpose

This script helps identify issues in your translation files by verifying if specific translations exist. It is provided as-is, without warranty of any kind. It is open-source, and you can modify it to suit your needs.