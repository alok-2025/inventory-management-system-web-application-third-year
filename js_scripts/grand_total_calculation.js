// JavaScript for calculating tax, shipping, and grand total
document.addEventListener('DOMContentLoaded', function() {
    const subtotal = parseFloat(document.getElementById('ctg_sbt').value);
    const salesTax = (subtotal * 0.30).toFixed(2);
    const shipping = (subtotal * 0.10).toFixed(2);
    const grandTotal = (subtotal + parseFloat(salesTax) + parseFloat(shipping)).toFixed(2);

    document.querySelector('.ctg_slstx').value = salesTax;
    document.querySelector('.ctg_shipping').value = shipping;
    document.querySelector('.ctg_gt').value = grandTotal;
});