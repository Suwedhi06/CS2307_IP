<%@ page import="java.sql.*" %>
<%@ page import="com.shopping.DBConnection" %>

<!DOCTYPE html>
<html>
<head>
    <title>Place Order</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f5f7fb;
        }

        .navbar {
            background: #222;
            padding: 18px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
        }

        .navbar a:hover {
            color: #4f9cff;
        }

        .container {
            width: 500px;
            margin: 45px auto;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 15px;
        }

        textarea {
            height: 80px;
            resize: none;
        }

        .btn {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            border: none;
            border-radius: 7px;
            background: #222;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background: #444;
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #222;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
</head>

<body>

<div class="navbar">
    <div class="logo">OnlineShopping</div>

    <div>
        <a href="index.jsp">Home</a>
        <a href="placeOrder.jsp">Place Order</a>
        <a href="orders.jsp">View Orders</a>
    </div>
</div>

<div class="container">

    <h1>Place Your Order</h1>

    <form method="post">

        <label>Customer Name</label>
        <input type="text" name="customer_name"
               placeholder="Enter your name" required>

        <label>Phone Number</label>
        <input type="text" name="phone"
               placeholder="Enter phone number" required>

        <label>Product</label>

        <select name="product_id" required>

            <%
                try {
                    Connection con = DBConnection.getConnection();

                    Statement st = con.createStatement();

                    ResultSet rs = st.executeQuery(
                        "SELECT product_id, product_name, price FROM products"
                    );

                    while (rs.next()) {
            %>

            <option value="<%= rs.getInt("product_id") %>">
                <%= rs.getString("product_name") %>
                - <%= rs.getDouble("price") %>
            </option>

            <%
                    }

                    con.close();

                } catch (Exception e) {
            %>

            <option>Error loading products</option>

            <%
                }
            %>

        </select>

        <label>Quantity</label>
        <input type="number" name="quantity"
               min="1" value="1" required>

        <label>Delivery Address</label>
        <textarea name="address"
                  placeholder="Enter delivery address"
                  required></textarea>

        <label>Delivery Date</label>
        <input type="date" name="delivery_date" required>

        <button class="btn" type="submit">
            Place Order
        </button>

    </form>

    <div class="links">
        <a href="index.jsp">Home</a>
        |
        <a href="orders.jsp">View Orders</a>
    </div>

<%
    if ("POST".equalsIgnoreCase(request.getMethod())) {

        String customerName = request.getParameter("customer_name");
        String phone = request.getParameter("phone");
        int productId = Integer.parseInt(request.getParameter("product_id"));
        int quantity = Integer.parseInt(request.getParameter("quantity"));
        String address = request.getParameter("address");
        String deliveryDate = request.getParameter("delivery_date");

        try {

            Connection con = DBConnection.getConnection();

            PreparedStatement ps1 = con.prepareStatement(
                "SELECT price FROM products WHERE product_id=?"
            );

            ps1.setInt(1, productId);

            ResultSet rs = ps1.executeQuery();

            if (rs.next()) {

                double price = rs.getDouble("price");
                double totalAmount = price * quantity;

                PreparedStatement ps2 = con.prepareStatement(
                    "INSERT INTO orders " +
                    "(customer_name, phone, product_id, quantity, " +
                    "total_amount, address, delivery_date) " +
                    "VALUES (?, ?, ?, ?, ?, ?, ?)"
                );

                ps2.setString(1, customerName);
                ps2.setString(2, phone);
                ps2.setInt(3, productId);
                ps2.setInt(4, quantity);
                ps2.setDouble(5, totalAmount);
                ps2.setString(6, address);
                ps2.setDate(7, java.sql.Date.valueOf(deliveryDate));

                ps2.executeUpdate();

                con.close();

                response.sendRedirect("orderSuccess.jsp");
            }

        } catch (Exception e) {

            out.println("<p style='color:red;text-align:center;'>");
            out.println("Error: " + e.getMessage());
            out.println("</p>");
        }
    }
%>

</div>

</body>
</html>