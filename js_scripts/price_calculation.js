const productPrices = {
		"Skin Lotion": 3.99,
		"Bathing Soap": 2.78,
		"Vaseline": 12.75,
		"Glycerine": 1.36,
		"Candle": 13.99,
		"Hand Sanitiser": 15.47
	};
	document.getElementById('product-select').addEventListener('change', updatePrice);
	document.getElementById('quantity').addEventListener('input', calculateTotal);

	function updatePrice() {
	  const selectedProduct = document.getElementById('product-select').value;
	  const price = productPrices[selectedProduct];
	  
	  if (price) {
	    document.getElementById('price-result').value = `${price.toFixed(2)}`;
	  } else {
	    document.getElementById('price-result').value = '';
	    document.getElementById('total-price').value = '';
	  }
	}
	function calculateTotal() {
	  const quantity = parseFloat(document.getElementById('quantity').value) || 0;
	  const selectedProduct = document.getElementById('product-select').value;
	  const price = productPrices[selectedProduct];
	  
	  if (price) {
	    const totalPrice = price * quantity;
	    document.getElementById('total-price').value = `${totalPrice.toFixed(2)}`;
	  } else {
	    document.getElementById('total-price').value = '';
	  }
	}