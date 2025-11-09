// Main JavaScript for AdVet

// Mobile Navigation Toggle
document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');
    
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
        });
    }
    
    // Quotation Modal
    const quotationModal = document.getElementById('quotationModal');
    const quoteButtons = document.querySelectorAll('.quote-btn');
    const modalCloses = document.querySelectorAll('.modal-close');
    
    quoteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const productName = this.dataset.productName || this.closest('.product-card').querySelector('h3').textContent;
            
            document.getElementById('productId').value = productId;
            document.getElementById('productName').value = productName;
            
            quotationModal.classList.add('show');
        });
    });
    
    modalCloses.forEach(close => {
        close.addEventListener('click', function() {
            const modal = this.closest('.modal');
            if (modal) {
                modal.classList.remove('show');
            }
        });
    });
    
    // Click outside modal to close
    if (quotationModal) {
        quotationModal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('show');
            }
        });
    }
    
    // Quotation Form Submit
    const quotationForm = document.getElementById('quotationForm');
    if (quotationForm) {
        quotationForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch('/dev/api/quotation_submit.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    alert(result.message || 'Quotation submitted successfully!');
                    quotationModal.classList.remove('show');
                    this.reset();
                } else {
                    alert(result.message || 'Error submitting quotation');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Network error. Please try again.');
            }
        });
    }
    
    // Contact Form Submit
    const contactForm = document.getElementById('contactForm');
    const contactMessage = document.getElementById('contactMessage');
    
    if (contactForm) {
        contactForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch('/dev/api/contact_submit.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (contactMessage) {
                    contactMessage.textContent = result.message;
                    contactMessage.className = 'form-message ' + (result.success ? 'success' : 'error');
                    contactMessage.style.display = 'block';
                }
                
                if (result.success) {
                    this.reset();
                    setTimeout(() => {
                        if (contactMessage) {
                            contactMessage.style.display = 'none';
                        }
                    }, 5000);
                }
            } catch (error) {
                console.error('Error:', error);
                if (contactMessage) {
                    contactMessage.textContent = 'Network error. Please try again.';
                    contactMessage.className = 'form-message error';
                    contactMessage.style.display = 'block';
                }
            }
        });
    }
    
    // Products Page - Search and Filter
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const productsGrid = document.getElementById('productsGrid');
    const noProducts = document.getElementById('noProducts');
    
    function filterProducts() {
        if (!productsGrid) return;
        
        const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
        const category = categoryFilter ? categoryFilter.value : '';
        
        const productCards = productsGrid.querySelectorAll('.product-card');
        let visibleCount = 0;
        
        productCards.forEach(card => {
            const cardName = card.dataset.name || '';
            const cardCategory = card.dataset.category || '';
            
            const matchesSearch = cardName.includes(searchTerm);
            const matchesCategory = !category || cardCategory === category;
            
            if (matchesSearch && matchesCategory) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        if (noProducts) {
            noProducts.style.display = visibleCount === 0 ? 'block' : 'none';
        }
    }
    
    if (searchInput) {
        searchInput.addEventListener('input', filterProducts);
    }
    
    if (categoryFilter) {
        categoryFilter.addEventListener('change', filterProducts);
    }
});
