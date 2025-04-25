<h1>Продукт "<?php echo $product['name']; ?>" из категории "<?php echo $product['category']; ?>"</h1>
<p>
    Цена: <?php echo $product['price']; ?>$, количество: <?php echo $product['quantity']; ?>
</p>
<p>
    Стоимость (цена * количество): <?php echo $product['price'] * $product['quantity']; ?>$
</p>