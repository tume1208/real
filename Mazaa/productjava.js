// Function to get query parameter by name
function getQueryParam(param) {
    let urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

let shop = document.getElementById("prodetails");

// Initialize basket if not already initialized
let basket = JSON.parse(localStorage.getItem("data")) || [];

// Function to retrieve user ID from local storage
const getUserId = () => localStorage.getItem('userId');

// Function to fetch user-specific cart data
const fetchUserCartData = async (userId) => {
    console.log('Fetching cart data for user:', userId); // Debugging: Log the user ID
    try {
        const response = await fetch(`fetch_user_cart.php?userId=${userId}`);
        const result = await response.json();
        if (result.success) {
            localStorage.setItem(`data_${userId}`, JSON.stringify(result.data));
            console.log('User cart data retrieved successfully');
            generateCartItems(); // Regenerate cart items with fetched data
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

let generateShop = () => {
    let productId = getQueryParam('id'); // Get the product ID from the URL
    if (!productId) {
        console.error('Product ID not found in URL');
        return;
    }
    fetch(`http://localhost/MAZAA/fetch_product_item.php?id=${productId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(selectedItem => {
            if (!selectedItem || selectedItem.error) {
                console.error('Product not found');
                return;
            }
            let { id, name, price, img, desc, images } = selectedItem;
            // Store product details in local storage
            localStorage.setItem(`product-${id}`, JSON.stringify({ id, name, price, img }));

            let search = basket.find((x) => x.id === id);
            let quantity = search ? search.item : 0;
            shop.innerHTML = `
                <div id=product-id-${id} class="single-pro-image">
                    <img src="images/${img}" width="100%" id="Mainimg" alt="">
                    <div class="small-img-group">
                        ${images.map(image => 
                            `<div class="small-img-col"> 
                                <img src="images/${image}" width="100%" class="small-img" alt="">
                            </div>`).join('')}
                    </div>
                </div>
                <div class="single-pro-details">
                    <h6>Home / Toner</h6>
                    <h4>${name}</h4>
                    <h1>₮ ${price}</h1>
                    <select>
                        <option> Toner</option>
                        <option> Gel Cleanser </option>
                        <option> Eye Cream </option>
                        <option> Sheet Mask </option>
                        <option> Intensive Cream </option>
                    </select>
                    <button class="normal">
                        <i onclick="increment(${id})" class="fa-solid fa-plus"></i>
                        <div id=${id} class="quantity">${quantity}</div>
                        <div>Сагсанд хийх</div>
                        <i onclick="decrement(${id})" class="fa-solid fa-minus"></i>
                    </button>
                    <h4>Бүтээгдэхүүний мэдээлэл</h4>
                    <span>
                        ${desc}
                        😊
                    </span>
                </div>
            `;
            // Add event listeners to small images 
            var Mainimg = document.getElementById("Mainimg"); 
            var smallimg = document.getElementsByClassName("small-img"); 
            for (var i = 0; i < smallimg.length; i++) {
                smallimg[i].onclick = function() {
                    Mainimg.src = this.src;
                }
            }
        })
        .catch(error => console.error('Error fetching product item:', error));
};

generateShop();

let increment = (id) => {
    let search = basket.find((x) => x.id === id);

    if (search === undefined) {
        basket.push({
            id: id,
            item: 1,
        });
    } else {
        search.item += 1;
    }
    update(id);
    updateLocalStorage();
    const userId = getUserId(); // Retrieve user ID from local storage
    sendLocalStorageDataToServer(userId, basket); // Store data on the server
};

let decrement = (id) => {
    let search = basket.find((x) => x.id === id);

    if (search === undefined || search.item === 0) return;
    else {
        search.item -= 1;
    }
    update(id);
    basket = basket.filter((x) => x.item !== 0);
    updateLocalStorage();
    const userId = getUserId(); // Retrieve user ID from local storage
    sendLocalStorageDataToServer(userId, basket); // Store data on the server
};

let update = (id) => {
    let search = basket.find((x) => x.id === id);
    document.getElementById(id).innerHTML = search.item;
};

let updateLocalStorage = () => {
    let basketWithItems = basket.filter(x => x.item > 0);
    localStorage.setItem("data", JSON.stringify(basketWithItems));
    const userId = getUserId(); // Retrieve user ID from local storage
    sendLocalStorageDataToServer(userId, basketWithItems); // Store data on the server
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

// Filter and log IDs with items in the basket
let basketWithItems = basket.filter(x => x.item > 0);
let idsWithItems = basketWithItems.map(x => x.id);

console.log(idsWithItems); // This will log the IDs with items in the basket
