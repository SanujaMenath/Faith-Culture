<footer class="bg-gray-900 text-white font-medium border-t-2 ">
    <!-- Main Footer Content -->
    <div class="container mx-auto px-6 py-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <h3 class="font-bold text-gray-200 text-lg mb-4">Faith Culture</h3>
                <p class="mb-4">Inspiring faith and community through shared values and thoughtful content.</p>
                <!-- Social Media Icons -->
                <div class="flex space-x-6 mt-4">
                    <a href="https://www.facebook.com/faithculture" class="transition-colors duration-300   hover:text-blue-600">
                        <i class="fa-brands fa-facebook fa-2x"></i>
                    </a>
                    <a href="https://www.instagram.com/faithculture._?igsh=eTBmd3Fwcm85Y3Zz" target="_blank" class="transition-colors duration-300  hover:text-pink-600">
                        <i class="fa-brands fa-instagram fa-2x"></i>
                    </a>
                    <a href="#" class="transition-colors duration-300  hover:text-green-600">
                        <i class="fa-brands fa-whatsapp fa-2x"></i>
                    </a>
                    <a href="#" class="transition-colors duration-300  hover:text-black">
                        <i class="fa-brands fa-tiktok fa-2x"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="font-bold text-gray-200 text-lg mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="/" class="hover:text-gray-400 transition-colors duration-300">Home</a></li>
                    <li><a href="/about" class="hover:text-gray-400 transition-colors duration-300">About Us</a></li>
                    <li><a href="/shop" class="hover:text-gray-400 transition-colors duration-300">Shop</a></li>
                    <li><a href="#" class="hover:text-gray-400 transition-colors duration-300">Contact</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div>
                <h3 class="font-bold text-gray-200 text-lg mb-4">Resources</h3>
                <ul class="space-y-2">

                    <li><a href="#" class="hover:text-gray-400 transition-colors duration-300">Community Groups</a></li>
                    <li><a href="#" class="hover:text-gray-400 transition-colors duration-300">Volunteer</a></li>
                    <li><a href="#" class="hover:text-gray-400 transition-colors duration-300">Donate</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="font-bold text-gray-200 text-lg mb-4">Stay Connected</h3>
                <p class="mb-4">Subscribe to our newsletter for updates and inspiration.</p>
                <form class="flex flex-col space-y-2">
                    <input type="email" placeholder="Your email address" 
                           class="px-4 py-2 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-black">
                    <button type="submit" 
                            class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-800 transition-colors duration-300">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t-2 border-gray-200">
        <div class="container mx-auto px-5 py-5">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class=" hover:border-b">&copy; 2025 Faith Culture. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-gray-400 transition-colors duration-300">Privacy Policy</a>
                    <a href="#" class="hover:text-gray-400 transition-colors duration-300">Terms of Service</a>
                    <a href="#" class="hover:text-gray-400 transition-colors duration-300">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Add these scripts before the closing body tag -->
<script>
    // Optional JavaScript for newsletter subscription
    document.addEventListener('DOMContentLoaded', function() {
        const newsletterForm = document.querySelector('footer form');
        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const emailInput = this.querySelector('input[type="email"]');
                const email = emailInput.value.trim();
                
                if (email) {
                    // Here you would typically send the email to your backend
                    // For demonstration, we'll just show an alert
                    alert('Thank you for subscribing with: ' + email);
                    emailInput.value = '';
                    
                    // In a real application, you would use AJAX to submit this to your Laravel backend
                    // Example with fetch:
                    /*
                    fetch('/newsletter/subscribe', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ email: email })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle success
                        emailInput.value = '';
                        // Show success message
                    })
                    .catch(error => {
                        // Handle error
                        console.error('Error:', error);
                    });
                    */
                }
            });
        }
    });
</script>