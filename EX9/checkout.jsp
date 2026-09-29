<%@ page import="java.sql.*" %>
<%@ page import="com.shopping.DBConnection" %>

<!DOCTYPE html>
<html>

<head>

    <title>Checkout</title>

    <style>

        body {
            font-family: Arial;
            background: #f5f5f5;
        }

        .box {
            width: 400px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        a {
            color: #333;
        }

    </style>

</head>

<body>

<div class="box">

<h2>Place Your Order</h2>

<%
    String productId = request.getParameter("product_id");

    String productName = "";
    double price = 0;

    if (productId != null) {

        try {

            Connection con = DBConnection.getConnection();

            String sql =
                "SELECT product_name, price FROM products WHERE product_id=?";

            PreparedStatement ps = con.prepareStatement(sql);

            ps.setInt(1, Integer.parseInt(productId));

            ResultSet rs = ps.executeQuery();

            if (rs.next()) {

                productName = rs.getString("product_name");
                price = rs.getDouble("price");
            }

            rs.close();
            ps.close();
            con.close();

        } catch (Exception e) {

            out.println("<p>Error: " + e.getMessage() + "</p>");
        }
    }
%>

<form method="post" action="checkout.jsp">

    <input type="hidden"
           name="product_id"
           value="<%= productId %>">

    <label>Customer Name</label>

    <input type="text"
           name="customer_name"
           required>

    <label>Product</label>

    <input type="text"
           value="<%= productName %>"
           readonly>

    <label>Price</label>

    <input type="text"
           value="<%= price %>"
           readonly>

    <input type="hidden"
           name="price"
           value="<%= price %>">

    <label>Quantity</label>

    <input type="number"
           name="quantity"
           min="1"
           value="1"
           required>

    <input type="submit"
           value="Place Order">

</form>

<%
    if ("POST".equalsIgnoreCase(request.getMethod())) {

        String customerName =
            request.getParameter("customer_name");

        int selectedProductId =
            Integer.parseInt(request.getParameter("product_id"));

        double selectedPrice =
            Double.parseDouble(request.getParameter("price"));

        int quantity =
            Integer.parseInt(request.getParameter("quantity"));

        double totalAmount =
            selectedPrice * quantity;

        try {

            Connection con =
                DBConnection.getConnection();

            String sql =
                "INSERT INTO orders "
                + "(customer_name, product_id, quantity, total_amount) "
                + "VALUES (?, ?, ?, ?)";

            PreparedStatement ps =
                con.prepareStatement(sql);

            ps.setString(1, customerName);
            ps.setInt(2, selectedProductId);
            ps.setInt(3, quantity);
            ps.setDouble(4, totalAmount);

            ps.executeUpdate();

            ps.close();
            con.close();

            response.sendRedirect("orderSuccess.jsp");

        } catch (Exception e) {

            out.println("<p>Error: " + e.getMessage() + "</p>");
        }
    }
%>

<br>

<a href="products.jsp">Back to Products</a>

</div>

</body>
</html>