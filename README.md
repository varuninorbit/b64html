# b64html
base64 data png to src convert

#convert base64 png data image to file

This script automatically converts base64 data image into image file saves it in the disc with
default path `blob`

## Usage
```php
<?php 
$html = '...... <img src="data:image/png;base64,..... >';

$b64 = new base64png($html);

$newHTML = $b64->get();

echo $newHTML

'......<img src="blob/{md5string_of_image_data}

```

### To set different path
```php
<?php
$b64 = new base64png($html,'custom/path');

```
