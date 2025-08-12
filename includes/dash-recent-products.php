<div class="col-xl-5 col-sm-12 col-12 d-flex">
						<div class="card flex-fill default-cover mb-4">
							<div class="card-header d-flex justify-content-between align-items-center">
								<h4 class="card-title mb-0">Recent Product Sales</h4>
								<div class="view-all-link">
									<a href="javascript:void(0);" class="view-all d-flex align-items-center">
										
									</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive dataview">
								<?php
// Include database connection
require 'config/config.php';

$query = "
    SELECT 
        o.id AS order_id,
        o.transaction_id,
        c.customer_name, 
        o.created_at AS sale_date, 
        o.total_price, 
        o.total_price, 
        o.payment_status, 
        o.payment_type, 
		oi.price,
		oi.product_name,

       
       
        CONCAT(e.first_name, ' ', e.last_name) AS biller,
        GROUP_CONCAT(CONCAT(oi.product_name, ' (', oi.quantity, ' x ', oi.price, ')') SEPARATOR ', ') AS order_items
    FROM orders o
    LEFT JOIN customers c ON o.customer_id = c.id
    LEFT JOIN employees e ON o.employee_id = e.id
    LEFT JOIN order_items oi ON o.id = oi.order_id
    GROUP BY o.id
    ORDER BY o.created_at DESC
	LIMIT 5
";
 // o.due_amount, 
 
$result = $conn->query($query);
?>
									<table class="table dashboard-recent-products">
										<thead>
											<tr>
												<th>#</th>
												<th>Products</th>
												<th>Price</th>
											</tr>
										</thead>
										<tbody>
										<?php while ($row = $result->fetch_assoc()) { ?>
											
											<tr>
												<td>#</td>
												<td class="productimgname">
													<a href="product-list.php" class="product-img">
														<img src="assets/img/products/dummy.png" alt="product">
													</a>
													<a href="#"><?= htmlspecialchars($row['product_name']); ?></a>
												</td>
												<td>KSH <?= htmlspecialchars($row['price']); ?></td>
											</tr>
											<?php } ?>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>