document.addEventListener('DOMContentLoaded', () => {
    const shopContainer = document.querySelector('.pro-container');
    const loadingIndicator = document.createElement('div');
    loadingIndicator.textContent = 'Loading products...';
    shopContainer.appendChild(loadingIndicator);

    const fetchProducts = async () => {
        try {
            const response = await fetch('http://localhost/MAZAA/fetch_products.php');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const responseText = await response.text();
            console.log('Response text:', responseText); // Log the raw response text

            const products = JSON.parse(responseText);
            console.log('Parsed products:', products); // Log the parsed products

            shopContainer.removeChild(loadingIndicator); // Remove loading indicator

            shopContainer.innerHTML = products.map(product => `
                <div id="product-id-${product.id}" class="pro" onclick="window.location.href='sproduct.html?id=${product.id}'">
                    <img src="images/${product.img}" alt="${product.name}">
                    <div class="des">
                        <span>${product.brand}</span>
                        <h5>${product.name}</h5>
                        <div class="star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <h4>${product.price}₮</h4>
                    </div>
                    <a href="#"><i class="fa-solid fa-bag-shopping"></i></a>
                </div>
            `).join('');
        } catch (error) {
            console.error('Error fetching products:', error);
            shopContainer.innerHTML = '<p>Failed to load products. Please try again later.</p>';
        }
    };

    fetchProducts();
});

