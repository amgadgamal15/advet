// Admin Products Management

function showAddProduct() {
    const modal = document.getElementById('productModal');
    const form = document.getElementById('productForm');
    const title = document.getElementById('modalTitle');
    const imagePreview = document.getElementById('currentImagePreview');
    
    form.reset();
    document.getElementById('productId').value = '';
    imagePreview.innerHTML = '';
    title.textContent = 'Add Product';
    modal.classList.add('show');
}

function editProduct(product) {
    const modal = document.getElementById('productModal');
    const form = document.getElementById('productForm');
    const title = document.getElementById('modalTitle');
    const imagePreview = document.getElementById('currentImagePreview');
    
    document.getElementById('productId').value = product.id;
    form.querySelector('[name="name_en"]').value = product.name_en;
    form.querySelector('[name="name_ar"]').value = product.name_ar;
    form.querySelector('[name="description_en"]').value = product.description_en;
    form.querySelector('[name="description_ar"]').value = product.description_ar;
    form.querySelector('[name="category"]').value = product.category;
    form.querySelector('[name="strength"]').value = product.strength;
    form.querySelector('[name="pack_size"]').value = product.pack_size;
    form.querySelector('[name="manufacturer"]').value = product.manufacturer;
    
    if (product.image && product.image !== 'placeholder.jpg') {
        imagePreview.innerHTML = `<div style="text-align: center;">
            <p>Current Image:</p>
            <img src="../assets/images/products/${product.image}" style="max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);" alt="Current product image">
        </div>`;
    } else {
        imagePreview.innerHTML = '';
    }
    
    title.textContent = 'Edit Product';
    modal.classList.add('show');
}

function closeProductModal() {
    const modal = document.getElementById('productModal');
    modal.classList.remove('show');
}

async function deleteProduct(id) {
    if (!confirm('Are you sure you want to delete this product?')) {
        return;
    }
    
    const formData = new FormData();
    formData.append('id', id);
    
    try {
        const response = await fetch('/dev/api/admin_delete_product.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert(result.message);
            location.reload();
        } else {
            alert(result.message || 'Error deleting product');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Network error. Please try again.');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const productForm = document.getElementById('productForm');
    
    if (productForm) {
        productForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const productId = document.getElementById('productId').value;
            
            const endpoint = productId ? '/dev/api/admin_edit_product.php' : '/dev/api/admin_add_product.php';
            
            try {
                const response = await fetch(endpoint, {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert(result.message || 'Error saving product');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Network error. Please try again.');
            }
        });
    }
    
    // Image preview on file select
    const imageInput = document.getElementById('productImage');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('currentImagePreview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<div style="text-align: center;">
                        <p>New Image Preview:</p>
                        <img src="${e.target.result}" style="max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);" alt="New product image preview">
                    </div>`;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Close modal on click outside
    const modal = document.getElementById('productModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeProductModal();
            }
        });
    }
});
