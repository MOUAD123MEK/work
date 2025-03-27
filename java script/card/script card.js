<script>
    // Initial product data
    let products = [
      { id: 1, intitule: 'Product A', price: 100, qte: 1 },
      { id: 2, intitule: 'Product B', price: 100, qte: 1 }
    ];

    // Function to update the total for the entire cart
    function updateTotal() {
      let total = products.reduce((sum, product) => sum + product.price * product.qte, 0);
      document.getElementById('total-panier').textContent = `Total Panier (HT) : ${total.toFixed(2)} €`;
    }

    // Function to render the product list
    function renderCart() {
      const cartBody = document.getElementById('cart-body');
      cartBody.innerHTML = ''; // Clear existing rows

      products.forEach((product, index) => {
        let row = document.createElement('tr');

        // Product name
        let nameCell = document.createElement('td');
        nameCell.textContent = product.intitule;
        row.appendChild(nameCell);

        // Price input
        let priceCell = document.createElement('td');
        let priceInput = document.createElement('input');
        priceInput.type = 'number';
        priceInput.value = product.price;
        priceInput.addEventListener('change', (e) => {
          product.price = parseFloat(e.target.value) || 0;
          updateTotal();
          renderCart();
        });
        priceCell.appendChild(priceInput);
        row.appendChild(priceCell);

        // Quantity controls
        let quantityCell = document.createElement('td');
        let decreaseButton = document.createElement('button');
        decreaseButton.textContent = '-';
        decreaseButton.addEventListener('click', () => {
          if (product.qte > 0) product.qte--;
          updateTotal();
          renderCart();
        });

        let quantityDisplay = document.createElement('span');
        quantityDisplay.textContent = product.qte;

        let increaseButton = document.createElement('button');
        increaseButton.textContent = '+';
        increaseButton.addEventListener('click', () => {
          product.qte++;
          updateTotal();
          renderCart();
        });

        quantityCell.appendChild(decreaseButton);
        quantityCell.appendChild(quantityDisplay);
        quantityCell.appendChild(increaseButton);
        row.appendChild(quantityCell);

        // Total price for the product
        let totalCell = document.createElement('td');
        totalCell.textContent = `${(product.price * product.qte).toFixed(2)} €`;
        row.appendChild(totalCell);

        // Remove button
        let actionCell = document.createElement('td');
        let removeButton = document.createElement('button');
        removeButton.textContent = 'Supprimer';
        removeButton.addEventListener('click', () => {
          products.splice(index, 1);
          updateTotal();
          renderCart();
        });
        actionCell.appendChild(removeButton);
        row.appendChild(actionCell);

        cartBody.appendChild(row);
      });

      updateTotal(); // Ensure the total is updated after rendering
    }

    // Initial render
    renderCart();
  </script>

