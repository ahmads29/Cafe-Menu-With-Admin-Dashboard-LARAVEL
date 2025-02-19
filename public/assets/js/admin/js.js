document.addEventListener('DOMContentLoaded', function () {
    // Function to create the new "page" content
    function createDetailPage(name, description, image) {
        // Hide all main content sections
        document.querySelectorAll('.container[id^="main-content"]').forEach(mainContent => {
            mainContent.style.display = 'none';
        });

        // Clear previous dynamic content
        const dynamicContent = document.getElementById('dynamic-content');
        dynamicContent.innerHTML = '';

        // Correct the image path to ensure it points to the correct folder
        const imagePath = `assets/images/${image}`;

        // Create the detail page structure
        const detailPage = document.createElement('div');
        detailPage.classList.add('container', 'mt-4');
        detailPage.innerHTML = `
            <button class="btn btn-warning mb-3" id="backButton">Back</button>
            <div class="card bg-dark text-white p-3">
                <img src="${imagePath}" alt="${name}" class="img-fluid mb-3" onerror="this.onerror=null;this.src='assets/images/no-image-icon.png';">
                <h3>${name}</h3>
                <p>${description}</p>
            </div>
        `;

        // Add the detail page to the dynamic content section
        dynamicContent.appendChild(detailPage);

        // Show the dynamic content
        dynamicContent.style.display = 'block';

        // Scroll to the top of the new content
        window.scrollTo({ top: 0, behavior: 'smooth' });

        // Add event listener to the back button
        document.getElementById('backButton').addEventListener('click', () => {
            // Hide the dynamic content
            dynamicContent.style.display = 'none';

            // Show all main content sections again
            document.querySelectorAll('.container[id^="main-content"]').forEach(mainContent => {
                mainContent.style.display = 'block';
            });
        });
    }

    // Load categories to populate the navbar
    async function loadCategories() {
        try {
            const response = await fetch('php/get_categories.php');
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const categories = await response.json();
    
            const navbar = document.querySelector('.header-menu');
            navbar.innerHTML = ''; // Clear any existing static categories
    
            categories.forEach(category => {
                const navItem = document.createElement('li');
    
                navItem.innerHTML = `
                    <a href="#">
                        <i class="${category.icon}"></i> ${category.name}
                    </a>
                `;
    
                // Add event listener to smooth scroll to the correct section if applicable
                navItem.querySelector('a').addEventListener('click', (event) => {
                    event.preventDefault();
                    const target = document.getElementById(`category-${category.id}`);
                    if (target) {
                        // Adjusting scroll position to ensure alignment with the top
                        window.scrollTo({
                            top: target.offsetTop - 60, // Adjust based on header height
                            behavior: 'smooth'
                        });
                    }
                });
    
                navbar.appendChild(navItem);
            });
    
        } catch (error) {
            console.error('Error fetching categories:', error);
        }
    }
    // Function to load menu items
async function loadMenuItems() {
    try {
        const response = await fetch('php/get_menu_items.php');
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        const items = await response.json();
        const mainContainer = document.querySelector('.main-conatiner'); // Updated target container

        mainContainer.innerHTML = ''; // Clear existing content

        // Group items by category
        const groupedItems = items.reduce((groups, item) => {
            if (!groups[item.category_id]) {
                groups[item.category_id] = [];
            }
            groups[item.category_id].push(item);
            return groups;
        }, {});

        // Create content for each category
        for (const categoryId in groupedItems) {
            const categorySection = document.createElement('div');
            categorySection.classList.add('category-container'); // Updated class

            // Fetch the category name from the first item
            const categoryName = groupedItems[categoryId][0].category_name || 'Category';
            categorySection.innerHTML = `<h1>${categoryName}</h1><div class="items-container-row"></div>`; // Updated HTML

            groupedItems[categoryId].forEach(item => {
                const itemCard = document.createElement('div');
                itemCard.classList.add('items-container'); // Updated class

                itemCard.innerHTML = `
                    <div class="item-img">
                        <img src="assets/images/${item.image || 'no-image-icon.png'}" alt="${item.name}">
                        <div class="favorite-icon">
                            <i class="fa-regular fa-heart" style="color: #ff0000;"></i>
                        </div>
                    </div>
                    <div class="item-details">
                        <p>${item.name}</p>
                        <p>${parseInt(item.price, 10).toLocaleString('en-US')} LBP</p>
                    </div>
                `;

                categorySection.querySelector('.items-container-row').appendChild(itemCard);

                // Attach click event listener to the item card
                itemCard.querySelector('.item-img').addEventListener('click', () => {
                    const name = item.name;
                    const description = item.item_description;
                    const image = item.image;
                    createDetailPage(name, description, image); // You can implement this to show a detailed view of the item
                });
            });

            mainContainer.appendChild(categorySection);
        }

    } catch (error) {
        console.error('Error fetching menu items:', error);
    }
}

// Initialize load on window load
window.onload = async () => {
    await loadCategories();
    await loadMenuItems();
};
});
