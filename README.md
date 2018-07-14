# spacer
a php library to encode your text into zerowidth characters to hide data within. e.g. fingerprinting


#Usage example
```
<?php
require_once "spacer.php";
$spacer = new Spacer();
$encoded_text = $spacer->space("finger_print_data", "your text entry here");
echo "Encoded: " . $encoded_text;
echo "Decoded: " . $spacer->unspace($encoded_text);
?>
```
