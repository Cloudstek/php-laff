# Largest Area Fit First (LAFF) 3D box packing algorithm class for PHP #

## Introduction ##

This PHP class helps to solve the so called "3D packing problem" often seen when packing containers with boxes (eg. for a webshop). It calculates the approximate minimum container size needed to fit the boxes and also gives additional information like on which level they are packed.

The class was written using the "An Efficient Algorithm for 3D Rectangular Box Packing" paper by M. Zahid Gürbüz, Selim Akyokus, Ibrahim Emiroglu and Aysun Güran. It contains a step by step explanation of the problem and the solution.

PDF file of the document: <http://www.zahidgurbuz.com/yayinlar/An%20Efficient%20Algorithm%20for%203D%20Rectangular%20Box%20Packing.pdf>

## Minimum Requirements ##

- PHP 5+

### Installation ###

1. Install with composer ```composer require cloudstek/php-laff``` or include the Packer.php file in your php code
2. Initialize the Packer class
3. Call the pack() method to start packing
4. Sit back, sip a beer and relax!

Example:
```php
// Initialize boxes array
$boxes = array(
	array(
		'length' => 50,
		'width'  => 35,
		'height' => 23
	),
	array(
		'length' => 18,
		'width'  => 38,
		'height' => 16
	)
);

// Initialize Packer
$laff = new \Cloudstek\PhpLaff\Packer();
$laff->pack($boxes);

// or

$laff = new \Cloudstek\PhpLaff\Packer($boxes);
$laff->pack();
```
	
Please see the examples directory for more examples!
