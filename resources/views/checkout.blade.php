<form action="{}" method="POST">
    @csrf
    <!-- Address, contact fields here -->

    <label for="payment_method">Select Payment Method:</label>
    <select name="payment_method" id="payment_method" class="p-2 border rounded">
        <option value="cod">Cash on Delivery</option>
        <option value="card">Card Payment</option>
    </select>

    <button type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Place Order
    </button>
</form>
