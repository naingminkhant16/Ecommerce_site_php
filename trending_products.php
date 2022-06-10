<!-- Trending Section Start -->
<div id="container" class="container my-5">
    <div class="featured-products my-5" id="trend">
        <div class="featured-products-title">
            <h2>TRENDING PRODUCTS</h2>
        </div>
    </div>
    <div id="slider-container">
        <span onclick="slideRight()" class="btn"></span>
        <div id="slider">
            <?php
            // $result = $db->crud("SELECT * FROM products ORDER BY id DESC LIMIT 6", null, null, true);
            $result = $db->orderBy('id', 'DESC')->limit(0, 6)->all('products');
            foreach ($result as $p) :
            ?>
                <div class="slide">
                    <a href="p_details.php?id=<?= $p->id ?>"><img src="admin/images/<?= $p->image ?>" alt="" class="img-fluid"></a>
                </div>
            <?php endforeach; ?>
        </div>
        <span onclick="slideLeft()" class="btn"></span>
    </div>
</div>
<!-- Trending Section End -->