<%@ page import="java.sql.*" %>
<%@ page import="com.shopping.DBConnection" %>

<!DOCTYPE html>
<html>
<head>
    <title>View Orders</title>

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

        .container {
            width: 95%;
            margin: 45px auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border-radius: 10px;
            overflow: hidden;
        }

        th {
            background: #222;
            color: white;
            padding: 15px;
        }

        td {
            padding: 13px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #f2f2f2;
        }

        .links {
            text-align: center;
            margin-top: 25px;
        }

        .links a {
            text-decoration: none;
            color: #222;
            margin: 10px;
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

    <h1>View Orders</h1>

    <table>

        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Phone</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Total Amount</th>
            <th>Address</th>
            <th>Delivery Date</th>
        </tr>

<%
    try {

        Connection con = DBConnection.getConnection();

        String sql =
            "SELECT o.order_id, o.customer_name, o.phone, " +
            "p.product_name, o.quantity, o.total_amount, " +
            "o.address, o.delivery_date " +
            "FROM orders o " +
            "JOIN products p ON o.product_id = p.product_id " +
            "ORDER BY o.order_id DESC";

        Statement st = con.createStatement();

        ResultSet rs = st.executeQuery(sql);

        while (rs.next()) {
%>

        <tr>

            <td><%= rs.getInt("order_id") %></td>

            <td><%= rs.getString("customer_name") %></td>

            <td><%= rs.getString("phone") %></td>

            <td><%= rs.getString("product_name") %></td>

            <td><%= rs.getInt("quantity") %></td>

            <td><%= rs.getDouble("total_amount") %></td>

            <td><%= rs.getString("address") %></td>

            <td><%= rs.getDate("delivery_date") %></td>

        </tr>

<%
        }

        con.close();

    } catch (Exception e) {
%>

        <tr>
            <td colspan="8">
                Error: <%= e.getMessage() %>
            </td>
        </tr>

<%
    }
%>

    </table>

    <div class="links">
        <a href="index.jsp">Home</a> |
        <a href="placeOrder.jsp">Place Order</a>
    </div>

</div>

</body>
</html>