<?php
session_start();

$products = [
  ["image"=>"assets/images/shop/livingroom/mika-armchair.svg","name"=>"Mika Armchair","category"=>"Living Room","price"=>185],
  ["image"=>"assets/images/shop/livingroom/mika-sofa.svg","name"=>"Mika Sectional Sofa","category"=>"Living Room","price"=>799],
  ["image"=>"assets/images/shop/livingroom/sore-velvet.svg","name"=>"Sora Velvet Ottoman","category"=>"Living Room","price"=>120],
  ["image"=>"assets/images/shop/livingroom/jute-rug.svg","name"=>"Taro Jute Rug","category"=>"Living Room","price"=>85],
  ["image"=>"assets/images/shop/livingroom/dara-mirror.svg","name"=>"Dara Mirror","category"=>"Living Room","price"=>110],
];

$productName = $_GET['name'];

$selectedProduct = null;

foreach ($products as $p) {
    if ($p['name'] === $productName) {
        $selectedProduct = $p;
        break;
    }
}

if(!$selectedProduct){
    header("Location: shop.php");
    exit;
}

if(isset($_SESSION['cart'][$productName])){

    $_SESSION['cart'][$productName]['qty']++;

} else {

    $_SESSION['cart'][$productName] = [
        "name" => $selectedProduct['name'],
        "price" => $selectedProduct['price'],
        "image" => $selectedProduct['image'],
        "qty" => 1
    ];
}

header("Location: cart.php");
exit;
?>