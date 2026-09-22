<?php
include "db_connect.php";
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders</title>
    <style>
        :root {
            --bg-color: #f3f4f6;
            --card-bg: #ffffff;
            --text-dark: #111827;
            --text-muted: #6b7280;
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --border-color: #e5e7eb;
            --table-header-bg: #f9fafb;
            --row-hover: #f9fafb;
            --badge-bg: #f3f4f6;
            --badge-text: #374151;
        }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; 
            background-color: var(--bg-color); 
            margin: 0;
            padding: 40px 20px;
            color: var(--text-dark);
        }
        .container {
            max-width: 1000px; 
            margin: 0 auto; 
            background: var(--card-bg);
            padding: 35px; 
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        }
        .header-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }
        h2 { 
            color: var(--text-dark); 
            margin: 0;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .btn-link {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }
        .btn-link:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }
        .table-responsive {
            overflow-x: auto;
            border: 1px solid var(--border-color);
            border-radius: 12px;
        }
        table { 
            border-collapse: collapse; 
            width: 100%; 
            font-size: 14px;
            background-color: var(--card-bg);
        }
        th, td { 
            padding: 16px 20px; 
            text-align: left; 
            border-bottom: 1px solid var(--border-color);
        }
        th { 
            background-color: var(--table-header-bg); 
            color: var(--text-muted); 
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
        tr:last-child td {
            border-bottom: none;
        }
        tr:hover td {
            background-color: var(--row-hover);
        }
        .badge {
            background-color: var(--badge-bg);
            color: var(--badge-text);
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 600;
            font-family: monospace;
        }
        .customer-name {
            font-weight: 600;
            color: var(--text-dark);
        }
        .total-text {
            font-weight: 700;
            color: var(--primary);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-wrapper">
            <h2>All Orders</h2>
            <a href="index.html" class="btn-link">Place a New Order</a>
        </div>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0) { ?>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><span class="badge">#<?php echo $row['order_id']; ?></span></td>
                                <td><span class="customer-name"><?php echo $row['customer_name']; ?></span></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td class="total-text">$<?php echo number_format($row['price'], 2); ?></td>
                                <td><span style="color: var(--text-muted);"><?php echo $row['order_date']; ?></span></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6" align="center" style="color: var(--text-muted); padding: 30px;">No orders found.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>
