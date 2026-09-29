<%@ page import="java.sql.*" %>
<%@ page import="com.shopping.DBConnection" %>

<!DOCTYPE html>
<html>

<head>
    <title>Products</title>

    <style>
        body {
            font-family: Arial;
            text-align: center;
            background: #f5f5f5;
        }

        table {
            width: 70%;
            margin: 30px auto;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
        }

        th {
            background: #333;
            color: white;
        }

        a {
            padding: 8px 15px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>

<h1>Available Products</h1>

<table>

<tr>
    <th>ID</th>
    <th>Product Name</th>
    <th>Price</th>
    <th>Action</th>
</tr>

<%
    Connection con = null;
    PreparedStatement ps = null;
    ResultSet rs = null;

    try {

        con = DBConnection.getConnection();

        String sql = "SELECT * FROM products";

        ps = con.prepareStatement(sql);

        rs = ps.executeQuery();

        while (rs.next()) {
%>

<tr>

    <td>
        <%= rs.getInt("product_id") %>
    </td>

    <td>
        <%= rs.getString("product_name") %>
    </td>

    <td>
        <%= rs.getDouble("price") %>
    </td>

    <td>
        <a href="checkout.jsp?product_id=<%= rs.getInt("product_id") %>">
            Buy Now
        </a>
    </td>

</tr>

<%
        }

    } catch (Exception e) {

        out.println("<p>Error: " + e.getMessage() + "</p>");

    } finally {

        try {
            if (rs != null) rs.close();
            if (ps != null) ps.close();
            if (con != null) con.close();
        } catch (Exception e) {
        }
    }
%>

</table>

<br>

<a href="index.jsp">Home</a>

</body>
</html>