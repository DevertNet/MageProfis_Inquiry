# MageProfis_Inquiry
Inquriy a product via e-mail.

### How to use:
1. Include the requierments.
2. Place the button in view.phtml

### Button
catalog/product/view.phtml
```html
<?php echo $this->getChildHtml('inquiry.button') ?>
```

### Mail Template
```app/locale/de_DE/template/email/inquiry_customer.html```

### Required
* Bootstrap CSS (Modal)
* Bootstrap Js (Modal)
* jQuery
* [jQuery formParams](https://github.com/tborychowski/formparams)


### Todo
* Translation
* Some Settings
* Support for custom options