<form action="charge.php" method="POST">
    <!-- Note that the amount is in paise = 50 INR -->
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="rzp_test_4M7P3ViBucYNrF"
        data-amount="10000"
        data-buttontext="Pay with Razorpay"
        data-name="PHPExpertise.com"
        data-description="Test Txn with RazorPay"
        data-image="https://your-awesome-site.com/your_logo.jpg"
        data-prefill.name="Harshil Mathur"
        data-prefill.email="support@razorpay.com"
        data-theme.color="#F37254"
    ></script>
    <input type="hidden" value="Hidden Element" name="hidden">
    </form>