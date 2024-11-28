let label = document.getElementById("cartTab");
let ShoppingCart = document.getElementById("shopping-cart");
let shopItemsData = [];

// Fetch the data from the PHP script
fetch('http://localhost/MAZAA/fetch_products.php')
    .then(response => response.json())
    .then(data => {
        console.log('Fetched shop items data:', data); // Log the fetched data
        shopItemsData = data;
        generateCartItemsForUser();
    })
    .catch(error => console.error('Error fetching shop items data:', error));

const getUserId = () => localStorage.getItem('userId'); // Function to retrieve user ID from local storage

let generateCartItemsForUser = () => {
    const userId = getUserId(); // Retrieve user ID from local storage
    let basket = JSON.parse(localStorage.getItem(`data_${userId}`)) || [];
    console.log('Basket data:', basket); // Log the basket data
    if (basket.length !== 0) {
        ShoppingCart.innerHTML = basket.map((x) => {
            let { id, item } = x;
            let product = shopItemsData.find(p => p.id === id.toString()); // Convert id to string for comparison
            if (!product) {
                console.error(`Product with id ${id} not found`);
                return '';
            }
            return `
                <div class="cart-item">
                    <table width="100%">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <td><i onclick="removeItem(${id})" id="bar" class="fa-solid fa-trash"></i></td>
                            <td><div class="image1"><img width="100%" src=images/${product.img} alt="" /></div></td>
                            <td><p1>${product.name}</p1></td>
                            <td><p1>${product.price}₮</p1></td>
                            <td>
                                <button class="normal1">
                                    <i onclick="increment(${id})" class="fa-solid fa-plus"></i>
                                    <div id=${id} class="quantity">${item}</div>
                                    <div>ширхэг</div>
                                    <i onclick="decrement(${id})" class="fa-solid fa-minus"></i>
                                </button>
                                <div class="trash"><i onclick="removeItem(${id})" id="bar" class="fa-solid fa-trash"></i></div>
                            </td>
                            <td><h3>${item * product.price}₮</h3></td>
                        </tbody>
                    </table>
                </div>
            `;
        }).join("");
        calculateTotalCost(); // Calculate total cost
    } else {
        ShoppingCart.innerHTML = ``;
        label.innerHTML = `<h1>Сагс хоосон байна</h1>
        <a href="shop.html">
            <button class="normal">back to</button>
        </a>`;
    }
};

let increment = (id) => {
    const userId = getUserId(); // Retrieve user ID from local storage
    let basket = JSON.parse(localStorage.getItem(`data_${userId}`)) || [];
    let search = basket.find((x) => x.id === id);

    if (search === undefined) {
        basket.push({ id: id, item: 1 });
    } else {
        search.item += 1;
    }
    localStorage.setItem(`data_${userId}`, JSON.stringify(basket));
    generateCartItemsForUser();
    update(id);
    sendLocalStorageDataToServer(userId, basket); // Store data on the server
    calculateTotalCost(); // Calculate total cost
};

let decrement = (id) => {
    const userId = getUserId(); // Retrieve user ID from local storage
    let basket = JSON.parse(localStorage.getItem(`data_${userId}`)) || [];
    let search = basket.find((x) => x.id === id);

    if (search === undefined || search.item === 0) return;
    search.item -= 1;
    basket = basket.filter((x) => x.item !== 0);
    localStorage.setItem(`data_${userId}`, JSON.stringify(basket));
    generateCartItemsForUser();
    update(id);
    sendLocalStorageDataToServer(userId, basket); // Store data on the server
    calculateTotalCost(); // Calculate total cost
};

let update = (id) => {
    const userId = getUserId(); // Retrieve user ID from local storage
    let basket = JSON.parse(localStorage.getItem(`data_${userId}`)) || [];
    let search = basket.find((x) => x.id === id);
    document.getElementById(id).innerHTML = search.item;
};

let removeItem = (id) => {
    const userId = getUserId(); // Retrieve user ID from local storage
    let basket = JSON.parse(localStorage.getItem(`data_${userId}`)) || [];
    basket = basket.filter((x) => x.id !== id);
    localStorage.setItem(`data_${userId}`, JSON.stringify(basket));
    generateCartItemsForUser();
    sendLocalStorageDataToServer(userId, basket); // Store data on the server
    calculateTotalCost(); // Calculate total cost
};

// Function to send local storage data to the server
const sendLocalStorageDataToServer = async (userId, data) => {
    console.log('Sending data to server:', { userId, data }); // Debugging: Log the data being sent
    try {
        const response = await fetch('store_local_storage.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ userId, data })
        });
        const result = await response.json();
        if (result.success) {
            console.log('Local storage data stored successfully');
        } else {
            console.error('Failed to store local storage data');
        }
    } catch (error) {
        console.error('Error storing local storage data:', error);
    }
};

// Fetch user-specific cart data when the page loads
const fetchUserCartData = async (userId) => {
    console.log('Fetching cart data for user:', userId); // Debugging: Log the user ID
    try {
        const response = await fetch(`fetch_user_cart.php?userId=${userId}`);
        const result = await response.json();
        if (result.success) {
            localStorage.setItem(`data_${userId}`, JSON.stringify(result.data));
            console.log('User cart data retrieved successfully');
            generateCartItemsForUser(); // Regenerate cart items with fetched data
        } else {
            console.error('Failed to retrieve user cart data');
        }
    } catch (error) {
        console.error('Error retrieving user cart data:', error);
    }
};

// Example: Call the function with the user ID
const userId = getUserId(); // Retrieve user ID from local storage
if (userId) {
    fetchUserCartData(userId);
} else {
    console.error('User ID not found in local storage');
}

// Generate cart items on page load

// Function to calculate total cost and store it in local storage
const calculateTotalCost = () => {
    const userId = getUserId(); // Retrieve user ID from local storage
    let basket = JSON.parse(localStorage.getItem(`data_${userId}`)) || [];
    let totalCost = basket.reduce((total, item) => {
        let product = shopItemsData.find(p => p.id === item.id.toString());
        return total + (product.price * item.item);
    }, 0);
    localStorage.setItem('totalCost', totalCost);
    console.log('Total cost:', totalCost); // Log the total cost
};

// Call this function whenever the cart is updated
calculateTotalCost();
generateCartItemsForUser();
