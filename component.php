<?php  

function component($productname,$productprice, $productimg, $productid){
	$element = "
                        <div class=\"col-lg-4 col-md-6 col-sm-6\">
                        <form method='POST' action=''>
                            <div class=\"product__item\">
                                <div class=\"product__item__pic set-bg\" data-setbg=\"$productimg\" style='background-image: url(\"$productimg\");'>
                                    <ul class=\"product__item__pic__hover\">
                                        <li><button href=\"#\"><i class=\"fa fa-heart\"></i></button></li>
                                        <li><button name=\"add\" type=\"submit\" ><i class=\"fa fa-shopping-cart\"></i></button></li>
                                        <input type='hidden' name='product_id' value='$productid'>
                                    </ul>
                                </div>
                                <div class=\"product__item__text\">
                                    <h6>$productname</h6>
                                    <h5>$productprice Ksh</h5>
                                </div>
                            </div>
                        </form>
                        </div>
	";
	echo $element;
}

function cartElement($productimg, $productname, $productprice, $productid){
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-4\">$productname</h5>
                                <h5 class=\"pt-4 pb-4\">$productprice Ksh</h5>
                                <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div>
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fa fa-minus\"></i></button>
                                    <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fa fa-plus\"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}

?>