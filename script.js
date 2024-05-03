// Define an array to store cart items
let cartItems = [];

// Function to add product to cart
function addToCart(productName) {
    // Create an object representing the product
    const product = {
        name: productName,
        price: getPrice(productName),
        quantity: 1
    };

    // Add the product to the cart
    cartItems.push(product);

    // Update cart count
    updateCartCount();

    
}

// Function to view product details
function viewProduct(productName) {
    
    console.log("Viewing product:", productName);
}

// Function to update cart count in the header
function updateCartCount() {
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = cartItems.length;
    }
}

// Function to get price of a product (replace this with your actual pricing logic)
function getPrice(productName) {
    // Dummy pricing logic, replace with actual logic
    switch (productName) {
        case 'Box of Chicago Style Topping':
            return 30.00;
        case 'Crunchy Deli Dills':
            return 20.00;
        case 'Crunchy Deli Spears':
            return 30.00;
        case 'Spicy Deli Spears':
            return 30.00;
        default:
            return 0.00; // Default price
    }
}
